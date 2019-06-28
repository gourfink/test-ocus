<?php

/*
You need to create a function that will validate if given parameters are valid geographical coordinates.

Valid coordinates look like the following: "23.32353342, -32.543534534". The return value should be either true or false.

Latitude (which is first float) can be between 0 and 90, positive or negative. Longitude (which is second float) can be between 0 and 180, positive or negative.

Coordinates can only contain digits, or one of the following symbols (including space after comma) __ -, . __

There should be no space between the minus "-" sign and the digit after it.

Here are some valid coordinates:

-23, 25
24.53525235, 23.45235
04, -23.234235
43.91343345, 143
4, -3
And some invalid ones:

23.234, - 23.4234
2342.43536, 34.324236
N23.43345, E32.6457
99.234, 12.324
6.325624, 43.34345.345
0, 1,2
0.342q0832, 1.2324
*/






/*
*	Validate if given parameters are valid geographical coordinates
*
*	$str : string
*/
function validate_coordonates($floats){

	$valid = true;

	$str = explode(',', $floats);
	$lat = floatval($str[0]);
	$lon = floatval($str[1]);

	if( count($str) > 0 && is_numeric($lat) && is_numeric($lon) ){
		// str is an array and lat & lon contain numeric strings...

		// check if strings contain only -,. and integer
		$string = str_split($floats);
		$period = 0;
		foreach($string as $k => $char){
			if( is_numeric($char) || $char === '-' || $char === ',' || $char === '.' || $char === ' ' ){
				// contain only ok chars

				if( $char === ',' ){
					if($string[$k+1] !== ' '){
						// there is no space near ,
						$valid = false;
						break;
					}
				}

				if( $char === '-' ){
					if( !is_numeric($string[$k+1]) ){
						// there is no numeric char near -
						$valid = false;
						break;
					}
				}

				if( $char === '.' ){
					$period++;
				}

				if( $period > 2 ){
					$valid = false;
				}

			}else{
				$valid = false;
				break;
			}
		}

		if( $lat > -90 && $lat <= 90 && $valid === true){
			return true;
		}else{
			return false;
		}

		if( $lon > -180 && $lon <= 180 && $valid === true  ){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}




echo '<pre>';
var_dump("Valides");
var_dump( validate_coordonates('-24.53525235, -23.45235') );
var_dump( validate_coordonates('-23, 25') );
var_dump( validate_coordonates('24.53525235, 23.45235') );
var_dump( validate_coordonates('04, -23.234235') );
var_dump( validate_coordonates('43.91343345, 143') );
var_dump( validate_coordonates('4, -3') );

// not valids
var_dump("Invalides");
var_dump( validate_coordonates('23.234, - 23.4234') );
var_dump( validate_coordonates('2342.43536, 34.324236') );
var_dump( validate_coordonates('N23.43345, E32.6457') );
var_dump( validate_coordonates('99.234, 12.324') );
var_dump( validate_coordonates('6.325624, 43.34345.345') );
var_dump( validate_coordonates('0, 1,2') );
var_dump( validate_coordonates('0.342q0832, 1.2324') );
echo '</pre>';





/*
	on aurait pu aussi utiliser des regex du type :

	$matchlat = preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/', $lat);
		
	$matchlon = preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/', $lon);

*/