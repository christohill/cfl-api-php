CFL.ca API wrapper for PHP
========

This is a simple PHP SDK for interacting with the CFL API. All API documentation can be found at http://api.cfl.ca.

Installation
------

`composer install christohill/cfl-api-php`

Usage
------
`Note: none of the API keys below are valid`

You can request access to the API at [api.cfl.ca/key-request](http://api.cfl.ca/key-request)

All endpoints in the API are mapped to their own methods in the wrapper. You can see all the [method names below](#methods). There is also a [folder full of examples](examples/) to reference.

#### Simple usage
```
use CFLPHP\Teams\Teams;
$teams = new Teams();
$teams->setKey('edf59be9216e66eb17093574376d4c5f');
$data = $teams->getTeams();
```

#### Setting API key
There are a few ways to set an API key.

1. Set an .env variable (CFLPHP_Key): `CFLPHP_Key="edf59be9216e66eb17093574376d4c5f"`
2. Set as an argument to the constructor: `$teams = new Teams('edf59be9216e66eb17093574376d4c5f')`
3. Use `setKey` setter method after the class has been instantiated:
```
$teams = new Teams();
$teams->setKey('edf59be9216e66eb17093574376d4c5f');
```

#### Request configuration
Most methods/endpoints accept some sort of configuration (include, sort, filter, pagination). Refer to [method names below](#methods) to see which accept these. These are set as a multidimensional array like this:

```
$config = array(
    'include' => array(),
    'sort' => array(),
    'filter' => array(),
    'pagination' => array()
);

$teams = new Games();
$data = $teams->getGames(2015, $config);
```

There is some special formatting for each config type:

##### Include
The API accepts comma separated values, so just a simple array will work for this:
```
$config = array(
    'include' => array(
        'boxscore',
        'rosters'
    )
);
```

##### Sort
The API accepts comma separated values, so just a simple array will work for this:
```
$config = array(
    'sort' => array(
        'height',
        '-weight'
    )
);
```
Note: Using **-** in front of the sort term will reverse the order

##### Filter
The API can accept multiple filters to try and narrow down the data you need. There is a slight change here from the original API to help keep these filters legible.
```
$config = array(
    'filter' => array(
        "team_2 == TOR",
        "team_1 == HAM"
    )
);
```
Instead of using the [property][operator] format, the wrapper uses simple strings with PHP style operators. The operators are as follows:

```
'==' => 'eq'
'!=' => 'ne'
'>' => 'gt'
'<' => 'lt'
'>=' => 'ge'
'<=' => 'le'
'in' => 'in'
```
[See how the operators work here](http://api.cfl.ca/docs#games-filters)

##### Pagination
Pagination is as simple as passing a page number and size to the config array.
```
$config = array(
    'pagination' => array(
        'number' => 2,
        'size' => 15
    )
);
```

Methods
------

| Method                                        | Description                                                   | Docs                                      |
| :---                                          | :---                                                          | :---                                      |
| getGames($season, $config)                    | Get a list of all games in a particular season                | [Read docs](http://api.cfl.ca/docs#games) |
| getSingleGame($season, $gameID, $config)      | Get data for a specific game                                  | [Read docs](http://api.cfl.ca/docs#games) |
| getLeaders($season, $category, $config)       | Get a list of leaders based on a statistical category         | [Read docs](http://api.cfl.ca/docs#leaders) |
| getTeamLeaders($season, $category, $config)   | Get a list of team leaders based on a statistical category    | [Read docs](http://api.cfl.ca/docs#team-leaders) |
| getPlayers($config)                           | Get a list of all players                                     | [Read docs](http://api.cfl.ca/docs#players) |
| getSinglePlayer($player_id, $config)          | Get all data for a specific player                            | [Read docs](http://api.cfl.ca/docs#players) |
| getStandings($season)                         | Get the team standings for a given season                     | [Read docs](http://api.cfl.ca/docs#standings) |
| getCrossoverStandings($season)                | Get the crossover team standings for a given season           | [Read docs](http://api.cfl.ca/docs#standings) |
| getTeams                                      | Get a list of all teams                                       | [Read docs](http://api.cfl.ca/docs#teams) |
| getTeamByID($team_id)                         | Get a CFL team by unique ID                                   | N/A |
| getTeamByAbbr($abbreviation)                  | Get a CFL team by team abbreviation                           | N/A |

TODO:
------

1. Finish all examples
2. Add a helper class for converting property ID to string. ie: Position ID > Position name
3. Play-by-play