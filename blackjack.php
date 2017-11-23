<?php
	require("functions.php");

	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}

	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Blackjack Game</title>
<link href="style.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script src="js/blackjack.js"></script>
</head>
<body>
	<div class='page'>
	<div style="text-align: center; padding-top: 15px; margin-left: 60px;">
	</div>
        <div class='dealer-cards'>

            <div class='card card1'></div>

            <div class='card flipped card2'></div>

            <div class='new-cards'></div>

            <div class='clear'></div>

            <div id='dealerTotal' class='dealer-total'></div>

        </div>

        <div class='clear'></div>

        <div class='player-cards'>

            <div class='card card1'></div>

            <div class='card card2'></div>

            <div class='new-cards'></div>

        	<div class='clear'></div>

            <div id='playerTotal' class='player-total'></div>


        </div>

        <div class='buttons'>
        	<div class='btn' id='hit'>Hit</div>
        	<div class='btn' id='stand'>Stand</div>
    	</div>
    	<div class='betting-area'>
    		<b>Your Bet</b><br />
    		<div id='bet' class='bet money'>0</div>

    		<div>
        		<div class='btn' id='more'>+</div>
        		<div class='btn' id='less'>-</div>
	    	</div>
    		<div class='clear'></div>
    	</div>
    	<div>
    		<b>Available Funds</b><br />
    		<span id='money' class='money'>500</span>
    		<div class='clear'></div>
    	</div>

        <div class='clear'></div>

        <div id='message' class='message'></div>
    </div>
</body>
</html>
