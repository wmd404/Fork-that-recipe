<? include("scripts/code.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Submission</title>
	<style type="text/css">
		fieldset { border: 0; padding: 20px; background: #ccc; margin: 0 0 20px 0; position: relative; }
		h3 { font: bold 18px Arial, Helvetica, sans-serif; margin: 0 0 20px 0; padding: 0; background: #ccc; }
		h4 { font: bold 16px Arial, Helvetica, sans-serif; margin: 10px 0; padding: 0; background: #ccc; }
		input, select, textarea { border: 1px solid #333; font-size: 14px Arial, Helvetica, sans-serif; padding: 5px; }
		input#recipe_name { width: 500px; }
		input.recipe_ingredient { width: 500px; }
		textarea { width: 500px; height: 300px; }
		.recipe_list { margin-bottom: 20px;  }
		.errorDiv {
			font: bold 18px Arial, Helvetica, sans-serif;
			float: left;
			color: firebrick;
		}
		#submitDiv {
			float: left;
			clear: both;
		}
		#de {
			clear: both;
		}
	</style>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript">
		function processJson(data) {
			if(data.OK == 1) {
				alert('recipe submitted successfully.');
				window.location.href = '/de/submit.html';
			} else {
			  $('div.errorDiv').html(data.message);
			}
		}

		$(document).ready(function(){
			        $('#de').ajaxForm({ 
				        // dataType identifies the expected content type of the server response 
			        dataType:  'json', 
						         // success identifies the function to invoke when the server response 
							         // has been received 
			         success:   processJson 
			     }); 
			$(".addingredient").click(function(){
				$("div.recipe_list:last").clone(true).insertAfter("div.recipe_list:last");
					  $('#de').ajaxForm({ //re-ajaxform if new fields are added
				        	dataType:  'json',
			        	 	success:   processJson 

			     }); 
			});
		});

	</script>
</head>
<body>
	<div class="errorDiv">

	</div>
	<br/>

	<form method="post" action="/de/scripts/data.php" id="de">
		<fieldset>
			<h3><label for="recipe_name">Recipe Name</label></h3>
			<input type="text" id="recipe_name" name="recipe_name" />
		</fieldset>
		<fieldset id="recipe_ingredient_list">
			<h3><label for="recipe_ingredient">Ingredients</label></h3>
			<div class="recipe_list">
				<input type="hidden" name="recipe_submit" value="1"/>
				<input type="text" id="recipe_ingredient" class="recipe_amount" name="recipe_amount[]" size="3" />
				<select class="recipe_measurement" name="recipe_measurement[]">
					<option value="teaspoon" 	label="teaspoon">	teaspoon	</option>
					<option value="tablespoon" 	label="tablespoon">	tablespoon	</option>
					<option value="ounce" 		label="ounce">		ounce		</option>
					<option value="package" 	label="package">	package		</option>
					<option value="cup" 		label="cup">		cup			</option>
					<option value="pint" 		label="package">	pint		</option>
					<option value="quart" 		label="quart">		quart		</option>
					<option value="gallon" 		label="gallon">		gallon		</option>
					<option value="pound" 		label="pound">		pound		</option>
					<option value="whole" 		label="whole">		whole		</option>
					<option value="half" 		label="half">		half		</option>
					<option value="dash" 		label="dash">		dash		</option>
					<option value="splash" 		label="splash">		splash		</option>
				</select>
				<input type="text" class="recipe_ingredient" name="recipe_ingredient[]" />
			</div>
			<div class="recipe_list">
				<input type="text" class="recipe_amount" name="recipe_amount[]" size="3" />
				<select class="recipe_measurement" name="recipe_measurement[]">
					<option value="teaspoon" 	label="teaspoon">	teaspoon	</option>
					<option value="tablespoon" 	label="tablespoon">	tablespoon	</option>
					<option value="ounce" 		label="ounce">		ounce		</option>
					<option value="package" 	label="package">	package		</option>
					<option value="cup" 		label="cup">		cup			</option>
					<option value="pint" 		label="package">	pint		</option>
					<option value="quart" 		label="quart">		quart		</option>
					<option value="gallon" 		label="gallon">		gallon		</option>
					<option value="pound" 		label="pound">		pound		</option>
					<option value="whole" 		label="whole">		whole		</option>
					<option value="half" 		label="half">		half		</option>
					<option value="dash" 		label="dash">		dash		</option>
					<option value="splash" 		label="splash">		splash		</option>
				</select>
				<input type="text" class="recipe_ingredient" name="recipe_ingredient[]" />
			</div>
			<div class="recipe_list">
				<input type="text" class="recipe_amount" name="recipe_amount[]" size="3" />
				<select class="recipe_measurement" name="recipe_measurement[]">
					<option value="teaspoon" 	label="teaspoon">	teaspoon	</option>
					<option value="tablespoon" 	label="tablespoon">	tablespoon	</option>
					<option value="ounce" 		label="ounce">		ounce		</option>
					<option value="package" 	label="package">	package		</option>
					<option value="cup" 		label="cup">		cup			</option>
					<option value="pint" 		label="package">	pint		</option>
					<option value="quart" 		label="quart">		quart		</option>
					<option value="gallon" 		label="gallon">		gallon		</option>
					<option value="pound" 		label="pound">		pound		</option>
					<option value="whole" 		label="whole">		whole		</option>
					<option value="half" 		label="half">		half		</option>
					<option value="dash" 		label="dash">		dash		</option>
					<option value="splash" 		label="splash">		splash		</option>
				</select>
				<input type="text" class="recipe_ingredient" name="recipe_ingredient[]" />
			</div>
			<div class="recipe_list">
				<input type="text" class="recipe_amount" name="recipe_amount[]" size="3" />
				<select class="recipe_measurement" name="recipe_measurement[]">
					<option value="teaspoon" 	label="teaspoon">	teaspoon	</option>
					<option value="tablespoon" 	label="tablespoon">	tablespoon	</option>
					<option value="ounce" 		label="ounce">		ounce		</option>
					<option value="package" 	label="package">	package		</option>
					<option value="cup" 		label="cup">		cup			</option>
					<option value="pint" 		label="package">	pint		</option>
					<option value="quart" 		label="quart">		quart		</option>
					<option value="gallon" 		label="gallon">		gallon		</option>
					<option value="pound" 		label="pound">		pound		</option>
					<option value="whole" 		label="whole">		whole		</option>
					<option value="half" 		label="half">		half		</option>
					<option value="dash" 		label="dash">		dash		</option>
					<option value="splash" 		label="splash">		splash		</option>
				</select>
				<input type="text" class="recipe_ingredient" name="recipe_ingredient[]" />
			</div>
			<div class="recipe_list">
				<input type="text" class="recipe_amount" name="recipe_amount[]" size="3" />
				<select class="recipe_measurement" name="recipe_measurement[]">
					<option value="teaspoon" 	label="teaspoon">	teaspoon	</option>
					<option value="tablespoon" 	label="tablespoon">	tablespoon	</option>
					<option value="ounce" 		label="ounce">		ounce		</option>
					<option value="package" 	label="package">	package		</option>
					<option value="cup" 		label="cup">		cup			</option>
					<option value="pint" 		label="package">	pint		</option>
					<option value="quart" 		label="quart">		quart		</option>
					<option value="gallon" 		label="gallon">		gallon		</option>
					<option value="pound" 		label="pound">		pound		</option>
					<option value="whole" 		label="whole">		whole		</option>
					<option value="half" 		label="half">		half		</option>
					<option value="dash" 		label="dash">		dash		</option>
					<option value="splash" 		label="splash">		splash		</option>
				</select>
				<input type="text" class="recipe_ingredient" name="recipe_ingredient[]" />
			</div>
			<input type="button" value="Add Ingredient" class="addingredient" />
		</fieldset>
		<fieldset>
			<h3><label for="recipe_directions">Directions</label></h3>
			<textarea id="recipe_directions" name="recipe_directions"></textarea>
			<h4><label for="recipe_preptime">Total Prep Time</label></h4>
			<input type="text" id="recipe_preptime" class="recipe_ingredient" name="recipe_preptime" />
			<h4><label for="recipe_cooktime">Total Cook Time</label></h4>
			<input type="text" id="recipe_cooktime" class="recipe_ingredient" name="recipe_cooktime" />
			<h4><label for="recipe_servings">Number of Servings</label></h4>
			<input type="text" id="recipe_servings" class="recipe_ingredient" name="recipe_servings" />
		</fieldset>
		<div class="errorDiv"></div>
		<br/>
		<div id="submitDiv">
		<input type="submit" value="Submit Your Recipe"/>
		</div>

	</form>

</body>
</html>
