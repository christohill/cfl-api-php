<?php

// http://api.cfl.ca/docs#standings
// Author: Chris Tohill
// http://visod.ca

namespace CFLPHP\Standings;

class Standings Extends \CFLPHP\Base {

	/**
	 * Get the team standings for a given season
	 * @param  Int $season 	The year of the season to select games from
	 * @return Object       Standings data for a specific season
	 */
	public function getStandings($season = NULL) {

		$season = $this->getYear($season);
		$endpoint = $this->buildEndpoint(['standings', $season]);

		return $this->sendRequest($endpoint);

	}




	/**
	 * Get the crossover team standings for a given season
	 * @param  Int $season 	The year of the season to select games from
	 * @return Object       Crossover standings data for a specific season
	 */
	public function getCrossoverStandings($season = NULL) {

		$season = $this->getYear($season);
		$endpoint = $this->buildEndpoint(['standings', 'crossover', $season]);

		return $this->sendRequest($endpoint);

	}

}