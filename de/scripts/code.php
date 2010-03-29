<? 
define('ACTION', trim(mysql_escape_string($_GET['action'])));
function select_id($valA, $valB) {
	if($valA == $valB) {
	?>SELECTED<?
	}
}
if(ACTION == "edit") {
	if(!$link = mysql_connect("localhost", "wmd404", "ch33zyp00fs")) {
		$response["message"] = "database connection unavailable.";
		exit;
	}
	$recipeID = intval($_GET['id']);
	if($recipeID) {
		$qry = "select * from recipe_to_ingredient left join recipe on recipe.recipe_id = recipe_to_ingredient.recipe_id ".
		" left join ingredient on ingredient.ingredient_id = recipe_to_ingredient.ingredient_id where recipe.recipe_id = '".$recipeID."' ";
		
	}
}
?>