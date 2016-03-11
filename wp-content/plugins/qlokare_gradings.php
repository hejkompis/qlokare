<?php
/*
Plugin Name: Qlokare Gradings
Plugin URI: http://www.medieinstitutet.se
Description: Finare plugin får man leta efter.
Author: Grupp 6
Version: 1.0
Author URI: http://www.medieinstitutet.se
*/

function qlokare_gradings_getcolor(){
	return get_option('qlokare_gradings_color');
}


function qlokare_gradings_admin_page(){
	if ($_POST['qlokare_gradings_changecolor_form'] == 'true'){
		// om formuläret är postat
		$color = $_POST['qlokare_gradings_color']; // bör tvättas och kollas!
		update_option('qlokare_gradings_color', $color);
	}
	else {
		// om sidan laddas utan att formuläret är postat
		$color = get_option('qlokare_gradings_color');
	}

	echo "<div class='wrap'>";
	echo "<h2>" . __("Qlokare Gradings", 'qlokare_gradings') . "</h2>";
	echo "<hr>";
	echo '</div>
	<div>
		<form method="post" action="">
			<b><p>Get:</p></b>
			<label for="student_id">Student:</label>
			<input type="text" name="student_id">
			<label for="course_id">Course:</label>
			<input type="text" name="course_id">
			<input type="hidden" name="getGrade"></input>
			<input type="submit">
		</form>
		<form method="post" action="">
		<b><p>New Grade Student in Course:</p></b>
			<label for="student">Student:</label>
			<input type="text" name="student_id">
			<label for="course">Course:</label>
			<input type="text" name="course_id">
			<label for="grade">Grade:</label>
			<input type="text" name="grade">
			<input type="hidden" name="gradeStudent"></input>
			<input type="submit">
		</form>
		<form method="post" action="">
			<b><p>Update grade for student in course:</p></b>
			<label for="id">Grade id:</label>
			<input type="text" name="id">
			<label for="student">Student:</label>
			<input type="text" name="student_id">
			<label for="course">Course:</label>
			<input type="text" name="course_id">
			<label for="grade">Grade:</label>
			<input type="text" name="grade">
			<input type="hidden" name="updateGrade"></input>
			<input type="submit">
		</form>
		<form method="post" action="">
			<b><p>Delete: </p></b>
			<label for="id">ID:</label>
			<input type	="text" name="id">
			<input type="hidden" name="deleteGrade"></input>
			<input type="submit">
		</form>
	</div>
	<div>';
			if (isset($_POST)) {
				$respons = requestAPI();
				var_dump($respons);
				// PUT FEEDBACK HTML and GET results here based on the response from API
				// FOR USER 
				// if sats
				// respons status okej
				// html fedback
				// else
				// html fedback
			}
		
	echo '</div>';
}

function qlokare_gradings_admin_menu(){
	add_options_page("Qlokare Gradings", "Qlokare Gradings", 1, "qlokare_gradings", 'qlokare_gradings_admin_page');
}

add_action('admin_menu', 'qlokare_gradings_admin_menu');



/* _____________ API CLIENT FUNCTIONS _____________*/

function requestAPI(){

	if (isset($_POST['gradeStudent'])) {
		$respons = postGrade();
	}

	elseif (isset($_POST['updateGrade'])) {
		$respons = putGrade();
	}

	elseif (isset($_POST['deleteGrade'])) {
		$respons = deleteGrade();
	}

	elseif (isset($_POST['getGrade'])) {
		$respons = getGrade();
	}
	else {
		$respons =  "Send one of the forms";
	}
	return $respons;
}



function getGrade(){
	//Choose data source from form
	$data = $_POST;

	//Call API with URL, HTTP method and data
	$json = call("http://192.168.33.14/api/?/courses/".$data['course_id']."/students/".$data['student_id']."/grades", "get", $data);

	//Return respons
	$respons = json_decode($json);
	return $respons;
}

function postGrade(){
	$data = $_POST;
	//Call API with URL, HTTP method and data
	$json = call("http://192.168.33.14/api/?/grades/", "post", $data);
	
	//Return respons
	$respons = json_decode($json);
	return $respons;
}

function putGrade(){
	$data = $_POST;
	// kollar databasen genom fråga till API:
	if(empty($data)) {
		$json = call("http://192.168.33.14/api/?/grades/", "get", $data);
		
		//Return respons
		$respons = json_decode($json);
		return $respons;
	}
	
	else{
		$json = call("http://192.168.33.14/api/?/grades/", "put", $data);
		
		//Return respons
		$respons = json_decode($json);
		return $respons;
	}
}

function deleteGrade(){
	$data = $_POST;
	// kollar databasen genom fråga till API:
	if(empty($data)) {
		$json = call("http://192.168.33.14/api/?/grades/", "get", $data);
		
		//Return respons
		$respons = json_decode($json);
		return $respons;
	}
	
	else{
		$json = call("http://192.168.33.14/api/?/grades/", "delete", $data);
		
		//Return respons
		$respons = json_decode($json);
		return $respons;
	}
}

function call($url, $method = "get", $data = []){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	switch ($method) {
		case 'post':
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		break;

		case 'put':
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		break;

		case 'delete':
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		break;
	}
	echo $respons = curl_exec($ch); 
	curl_close($ch);

	return $respons;
}

?>