<?php

require_once('../vendor/autoload.php');

use CFLPHP\Teams\Teams;

$apiKey = "edf59be9216e66eb17093574376d4c5f"; // Not a valid key

// This example will return a list of all teams
echo "<h1>1) List all teams/h1>";

$teams = new Teams();
$teams->setKey($apiKey);
$data = $teams->getTeams();
// Dump data
var_dump($data);

// This example will get a single team by its ID
echo "<h1>2) Single Team by ID</h1>";

$teams = new Teams();
$teams->setKey($apiKey);
$data = $teams->getTeamByID(2);
// Dump data
var_dump($data);

// This example will get a single team by its abbreviation
echo "<h1>3) Single Team by abbreviation</h1>";

$teams = new Teams();
$teams->setKey($apiKey);
$data = $teams->getTeamByAbbr('OTT');
// Dump data
var_dump($data);