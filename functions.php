<?php
	$database = "if17_valevale";

	//alustan sessiooni
	session_start();
	$signupPoints = 1000;
	//sisselogimise funktsioon
	function signIn($email, $password){
		$notice = "";
		//andmebaasi ühendus
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, email, password FROM usersbj WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
		$stmt->execute();

		//kontrollin vastavust
		if($stmt->fetch()){
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Kõik õige! Logisite sisse!";

				//määrame sessioonimuutujad
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;

				//liigume pealehele
				header("Location: blackjack.php");
				exit();
			} else {
				$notice = "Vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei leitud!";
		}
		$stmt->close();
		$mysqli->close();
		return $notice;
	}

	//kasutaja andmebaasi salvestamine
	function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword, $signupPoints){
		//loome andmebaasiühenduse

		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO usersbj (firstname, lastname, birthday, gender, email, password, points) VALUES (?, ?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer
		//d - decimal
		$stmt->bind_param("sssissi", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword, $signupPoints);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}

	//sisestuse testimise funktsioon
	function test_input($data){
		$data = trim($data);//eemaldab lõpust tühikud, TAB jne
		$data = stripcslashes($data);//eemaldab "\"
		$data = htmlspecialchars($data); //eemaldab keelatud märgid
		return $data;
	}


?>
