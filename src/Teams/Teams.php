<?php

// http://api.cfl.ca/docs#teams
// Author: Chris Tohill
// http://visod.ca

namespace CFLPHP\Teams;

class Teams Extends \CFLPHP\Base {

	/**
	 * Get a list of all teams
	 * @return Object Basic data for all CFL teams
	 */
	public function getTeams($config = array()) {

		$endpoint = $this->buildEndpoint(['teams']);

		return $this->sendRequest($endpoint, $config);

	}




	/**
	 * Get a CFL team by unique ID
	 * @param  Int $id 		Unique team ID
	 * @return Object      	Data for a specific CFL team
	 */
	public function getTeamByID($id = 1) {

		$teams = $this->getTeams();

		foreach($teams as $team) {
			if($team->team_id == $id) {
				$return = $team;
				break;
			}
		}

		return (!empty($return)) ? $return : FALSE;

	}




	/**
	 * Get a CFL team by team abbreviation
	 * @param  String $abbr 3 letter abbreviation for a team
	 * @return Object       Data for a specific CFL team
	 */
	public function getTeamByAbbr($abbr = "CGY") {

		$teams = $this->getTeams();

		foreach($teams as $team) {
			if(strtolower($team->abbreviation) == strtolower($abbr)) {
				$return = $team;
				break;
			}
		}

		return (!empty($return)) ? $return : FALSE;

	}

}