<?php

// http://api.cfl.ca/docs#players
// Author: Chris Tohill
// http://visod.ca

namespace CFLPHP\Players;

class Players Extends \CFLPHP\Base {

	/**
	 * Get a list of all players
	 * @param  Array  $config 	Filter, Sort, Include, etc configuration array
	 * @return Object         	A list of all players
	 */
	public function getPlayers($config = array()) {

		$endpoint = $this->buildEndpoint(['players']);

		return $this->sendRequest($endpoint, $config);

	}




	/**
	 * Get all data for a specific player
	 * @param  Int $id     		The unique ID for a specific CFL player
	 * @param  Array  $config 	Filter, Sort, Include, etc configuration array
	 * @return Object         	Data for a specific player
	 */
	public function getSinglePlayer($id, $config = array()) {

		$endpoint = $this->buildEndpoint(['players', $id]);

		return $this->sendRequest($endpoint, $config);

	}

}