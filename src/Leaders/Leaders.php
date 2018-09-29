<?php

// http://api.cfl.ca/docs#leaders
// http://api.cfl.ca/docs#team-leaders
// Author: Chris Tohill
// http://visod.ca

namespace CFLPHP\Leaders;

class Leaders Extends \CFLPHP\Base {

	/**
	 * Get a list of leaders based on a statistical category
	 * @param  Int $season   	The year of the season to select leaders from
	 * @param  string $category The category name http://api.cfl.ca/docs#leaders-endpoints
	 * @return Object           A list of leaders from the selected category
	 */
	public function getLeaders($season = NULL, $category = 'offence', array $config) {

		$season = $this->getYear($season);
		$endpoint = $this->buildEndpoint(['leaders', $season, 'category', $category]);

		return $this->sendRequest($endpoint, $config);

	}




	/**
	 * Get a list of team leaders based on a statistical category
	 * @param  Int $season   	The year of the season to select team leaders from
	 * @param  string $category The category name http://api.cfl.ca/docs#team-leaders-endpoints
	 * @return Object           A list of team leaders from the selected category
	 */
	public function getTeamLeaders($season = NULL, $category = 'all', array $config) {

		$season = $this->getYear($season);
		$endpoint = $this->buildEndpoint(['team_leaders', $season, 'category', $category]);

		return $this->sendRequest($endpoint, $config);

	}

}