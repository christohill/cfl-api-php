<?php

require_once('../vendor/autoload.php');

use CFLPHP\Games\Games;

$apiKey = "edf59be9216e66eb17093574376d4c5f"; // Not a valid key

// This example will return a list of games
echo "<h1>1) List games</h1>";
$games = new Games();
$games->setKey($apiKey);
$data = $games->getGames(2018);
// Dump data
var_dump($data);

// This example will return a list of games with boxscore
echo "<h1>2) List games with boxscore</h1>";
$games = new Games();
$games->setKey($apiKey);
$config = array(
	'include' => array(
		'boxscore'
	)
);
$data = $games->getGames(2018, $config);
// Dump data
var_dump($data);

// This example will return data for a specific game
echo "<h1>3) Single game data</h1>";
$games = new Games();
$games->setKey($apiKey);
$data = $games->getSingleGame(2018, 2457);
var_dump($data);

// This example will return data for a specific game including boxscore and rosters
echo "<h1>3) Single game data with boxscore and rosters</h1>";
$games = new Games();
$games->setKey($apiKey);
$config = array(
	'include' => array(
		'boxscore',
		'rosters'
	)
);
$data = $games->getSingleGame(2018, 2457, $config);
var_dump($data);