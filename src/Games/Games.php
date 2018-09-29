<?php

// http://api.cfl.ca/docs#games
// Author: Chris Tohill
// http://visod.ca

namespace CFLPHP\Games;

class Games Extends \CFLPHP\Base {

	/**
	 * Get a list of all games in a particular season
	 * http://api.cfl.ca/docs#games-endpoints
	 * @param  Int $season 		The year of the season to select games from
	 * @param  array  $config 	Filter, Sort, Include, etc configuration array
	 * @return Object         	A list of games object
	 */
	public function getGames($season = NULL, $config = array()) {

		$endpoint = $this->buildEndpoint(['games', $season]);

		return $this->sendRequest($endpoint, $config);

	}



	/**
	 * Get data for a specific game
	 * http://api.cfl.ca/docs#games-endpoints
	 * @param  Int $season 		The year of the season to select games from
	 * @param  Int $gameID 		The unique ID of the game requested
	 * @param  Array  $config 	Filter, Sort, Include, etc configuration array
	 * @return Object         	A single game object
	 */
	public function getSingleGame($season = NULL, $gameID = NULL, $config = array()) {

		$season = $this->getYear($season);
		$endpoint = $this->buildEndpoint(['games', $season, 'game', $gameID]);

		return $this->sendRequest($endpoint, $config);

	}

}