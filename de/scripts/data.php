<?
require($_SERVER['DOCUMENT_ROOT']."/lib/jsonwrapper/jsonwrapper.php");
function bail($response) {
	echo json_encode($response);
	exit;
}
$response = array("OK" => 0, "message" => "Form submission invalid", "recipeID" => 0);
if($_POST['recipe_submit']) {
if(!$link = mysql_connect("localhost", "wmd404", "ch33zyp00fs")) {
	$response["message"] = "database connection unavailable.";
	bail($response);
}
if(!mysql_select_db("wmd404", $link)) {
	$response["message"] = "database is unavailable.";
	bail($response);
}

	//$_POST = array_map('mysql_escape_string', $_POST);
	$required = array("Recipe Name" => $_POST['recipe_name'],
			  "Directions" => $_POST['recipe_directions'],
			  "Prep Time" => $_POST['recipe_preptime'],
			  "Total Cook Time" => $_POST['recipe_cooktime'],
			  "Number of Servings" => $_POST['recipe_servings']);
 /*
[recipe_amount] => Array ( [0] => 1 [1] => 3 [2] => 2 [3] => 8 [4] => 4 ) [recipe_measurement] => Array ( [0] => teaspoon [1] => gallon [2] => whole [3] => dash [4] => cup ) [recipe_ingredient] => Array ( [0] => fish oil [1] => coke [2] => footballs [3] => tobasco [4] => salsa )
 */
 	$invalid = 0;
	if(is_array($_POST['recipe_amount'])) {
		foreach($_POST['recipe_amount'] as $num => $val) {
		    if(intval($val) < 1) {
			$invalid ++;	
		    }
		}
		if(is_array($_POST['recipe_ingredient'])) {
			foreach($_POST['recipe_ingredient'] as $num => $ingredient) {
			     if($ingredient == "") {
				$invalid ++;
			     } else {
			     	$ingredient = mysql_escape_string($ingredient);
				$qry = "insert into ingredient (ingredient_name) values('".$ingredient."') ".
					" on duplicate key update ingredient_name = '".$ingredient."' ";
				if(!mysql_query($qry, $link)) {
					$response["message"] .= mysql_error()."<br/>";
				}
			    }
			}
		}
	}
	if($invalid) {
		$response["message"] = "At least one ingredient or ingredient amount is invalid.";
		bail($response);
	}
	foreach($required as $descrip => $value) {
		if($value == "") {
			$invalid ++;
			$response["message"] .= $descrip." is required.<br/>";
		}	
	}
	if($invalid) {
		bail($response);
	}
	/*
	CREATE TABLE `recipe` (
	  `recipe_id` int(11) NOT NULL auto_increment,
	    `post_date` datetime NOT NULL default '0000-00-00 00:00:00',
	      `posted_by` int(11) NOT NULL default '1',
	        `recipe_name` varchar(250) NOT NULL default '',
		  `recipe_directions` text NOT NULL,
		  `recipe_preptime` varchar(250) NOT NULL default '',  
		  `recipe_cooktime` varchar(250) NOT NULL default '', 
		  PRIMARY KEY  (`recipe_id`),
		    KEY `post_date` (`post_date`)
		    ) ENGINE=MyISAM DEFAULT CHARSET=utf8; 
	*/
	$qry = "insert into recipe values('', now(), 1, '".mysql_escape_string($_POST['recipe_name'])."', '".mysql_escape_string($_POST['recipe_directions'])."', ".
		" '".mysql_escape_string($_POST['recipe_preptime'])."', '".mysql_escape_string($_POST['recipe_cooktime'])."') ";
	if(!mysql_query($qry, $link)) {
	$response["message"] = "Recipe entry failed. ".mysql_error()."<br/>";
	bail($response);
	}
	$response["OK"] = 1;
	$response["message"] = "Recipe submitted successfully.<br/>";
	$new_recipe_id = mysql_insert_id();
	$response["recipeID"] = $new_recipe_id;
	//attempt to match ingredients with new recipe id.. reset them as numeric values
	$ct = count($_POST['recipe_ingredient']);
	for($a = 0; $a < $ct; $a ++) {
		$qry = "select ingredient_id from ingredient where ingredient_name='".mysql_escape_string($_POST['recipe_ingredient'][$a])."' ";
		$_POST['recipe_ingredient'][$a] = mysql_result(mysql_query($qry), 0);
	}
	/*
	CREATE TABLE `recipe_to_ingredient` (
	  `recipe_id` int(11) NOT NULL,
	    `ingredient_id` int(11) NOT NULL,
	      `amount` int(11) NOT NULL default '1',
	      `measurement` varchar(100) NOT NULL default '',
	        PRIMARY KEY  (`recipe_id`),
		  KEY `ingredient_id` (`ingredient_id`)
		  ) ENGINE=MyISAM DEFAULT CHARSET=utf8; 
	*/
	for ($a = 0; $a < $ct; $a ++) {
		$qry = "insert into recipe_to_ingredient values('".$new_recipe_id."', '".mysql_escape_string($_POST['recipe_ingredient'][$a])."', ".
			" '".mysql_escape_string($_POST['recipe_amount'][$a])."', '".mysql_escape_string($_POST['recipe_measurement'][$a])."')";
		 if(!mysql_query($qry, $link)) {
		 	$response["OK"] = 0;
		         $response["message"] .= "Recipe ingredient map failed. ".mysql_error()."<br/>";
		 }

	}
	bail($response);
//	$recipe_ingredient_values = array($new_recipe_id => "amounts" => $_POST['recipe_amount'], "measurements" => $_POST['recipe_measurement'], 
//		"ingredients" => $_POST['recipe_ingredient']);
}
?>
