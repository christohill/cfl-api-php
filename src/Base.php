<?php

// http://api.cfl.ca/docs
// Author: Chris Tohill
// http://visod.ca

namespace CFLPHP;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\BadResponseException;
use CFLPHP\Exceptions\CFLException;

class Base {

	protected $key;
	protected $client;
	
	public function __construct($key = NULL) {

		// Set API key through environment variable or class argument
		// Can also be set with public method setKey
		if(isset($_ENV['CFLPHP_Key'])) {
			$this->setKey($_ENV['CFLPHP_KEY']);
		}elseif (!empty($key)) {
			$this->setKey($key);
		}

		$this->client = new Client([
			'base_uri' => 'http://api.cfl.ca/v1/'
		]);

	}




	/**
	 * Set the API key of the instantiated object
	 * @param String $key API key string
	 */
	public function setKey($key) {
		$this->key = $key;
	}




	/**
	 * Send the compiled request to api.cfl.ca
	 * @param  String $endpoint The built endpoint to send the request to
	 * @param  Array  $config   An array containing the different request configuration options
	 * @return Object           The JSON API response decoded into a PHP Object
	 */
	public function sendRequest($endpoint, $config = array()) {

		$query = array();

		// Add API key to query array
		$query['key'] = $this->key;

		// Add include parameters to query
		if(!empty($config['include'])) {
			$query['include'] = $this->buildIncludeQueryString($config['include']);
		}

		// Add sort parameters to query
		if(!empty($config['sort'])) {
			$query['sort'] = $this->buildSortQueryString($config['sort']);
		}

		// Add filter parameters to query
		if(!empty($config['filter'])) {
			$query = array_merge($query, $this->buildFilterQueryString($config['filter']));
		}

		// Apply pagination to the response
		if(!empty($config['paging'])) {
			$query = array_merge($query, $this->buildPagingQueryString($config['paging']));
		}

		$queryString = \GuzzleHttp\Psr7\build_query($query, FALSE);

		try {
			$response = $this->client->get($endpoint . '?' . $queryString);
			$data = json_decode($response->getBody());
			return $data->data;
		} catch (\Exception $e) {
			echo $e->getMessage();
        }


	}




	/**
	 * Return the current year if no year is passed
	 * @param  Int $year 	The year being passed to the method
	 * @return Int       	Returns either the current year, or the year passed
	 */
	protected function getYear($year = NULL) {

		if($year == NULL || !is_int($year)) {
			$year = date('Y');
		}

		return $year;

	}




	/**
	 * Builds a URL slug/endpoint from an array of items
	 * @param  Array  $segments A collection of segments to be combined into a URI
	 * @return String           The combined items, separated by a forward slash
	 */
	protected function buildEndpoint(array $segments) {

		$slug = implode('/', $segments);
		return $slug;

	}




	/**
	 * Builds a URL query for includes from an array of items
	 * @param  Array $includes 	A collection of includes to be combined into a query parameter
	 * @return String           The combined items, separated by a comma
	 */
	protected function buildIncludeQueryString(array $includes) {

		$includes = implode(',', $includes);
		return $includes;

	}




	/**
	 * Builds a URL query for filters from an array of items
	 * Converts common operators into CFL API recognized operators
	 * @param  Array $filters 	A collection of filters to be combined into a query parameter
	 * @return Array           	Returns an array formatted for the CFL API. This will be convered to a string at run time
	 */
	protected function buildFilterQueryString(array $filters) {

		$return = array();

		$operators = array(
			'==' => 'eq',
			'!=' => 'ne',
			'>' => 'gt',
			'<' => 'lt',
			'>=' => 'ge',
			'<=' => 'le',
			'in' => 'in'
		);

		foreach($filters as $filter) {
			
			$pieces = explode(' ', $filter);

			$filter = $pieces[0];
			$operator = $operators[$pieces[1]];
			$value = $pieces[2];

			$return["filter[{$filter}][{$operator}]"] = $value;

		}

		return $return;

	}




	/**
	 * Builds a URL query for sorting from an array of items
	 * @param  Array $sort 		A collection of sort rules to be combined into a query parameter
	 * @return String           The combined items, separated by a comma
	 */
	protected function buildSortQueryString(array $sort) {
		$sort = implode(',', $sort);
		return $sort;
	}




	/**
	 * Builds a URL query for pagination of a collection
	 * @param  Array $sort 		An array including the page number and page size
	 * @return Array           	Returns an array formatted for the CFL API. This will be convered to a string at run time
	 */
	protected function buildPagingQueryString($paging) {

		$return = array();

		$return['page[number]'] = $paging['number'];
		$return['page[size]'] = $paging['size'];

		return $return;

	}

}