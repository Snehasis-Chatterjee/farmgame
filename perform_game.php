<?php
session_start();

if(isset($_SESSION['animals']) && isset($_SESSION['animal_life']) && isset($_SESSION['final_result']))
{
	perform_game_logic();
}
else
{
	$_SESSION['animals'] = array("Farmer","Cow1","Cow2","Bunny1","Bunny2","Bunny3","Bunny4");
	$_SESSION['animal_life'] = array('F'=>15,'C1'=>10,'C2'=>10,'B1'=>8,'B2'=>8,'B3'=>8,'B4'=>8);
	perform_game_logic();
}

function perform_game_logic()
{
	$no_of_times_button_clicked = $_POST['button_clicked'];
	$random_animal = $_SESSION['animals'][array_rand($_SESSION['animals'],1)];
	$_SESSION['final_result'][] = array($no_of_times_button_clicked => $random_animal);

	switch ($random_animal) {
		case "Farmer":
			$_SESSION['animal_life']['F'] = 15;
			$_SESSION['animal_life']['C1'] -= 1;
			$_SESSION['animal_life']['C2'] -= 1;
			$_SESSION['animal_life']['B1'] -= 1;
			$_SESSION['animal_life']['B2'] -= 1;
			$_SESSION['animal_life']['B3'] -= 1;
			$_SESSION['animal_life']['B4'] -= 1;
			break;
		case "Cow1":
			$_SESSION['animal_life']['C1'] = 10;
			$_SESSION['animal_life']['F'] -= 1;
			$_SESSION['animal_life']['C2'] -= 1;
			$_SESSION['animal_life']['B1'] -= 1;
			$_SESSION['animal_life']['B2'] -= 1;
			$_SESSION['animal_life']['B3'] -= 1;
			$_SESSION['animal_life']['B4'] -= 1;
			break;
		case "Cow2":
			$_SESSION['animal_life']['C2'] = 10;
			$_SESSION['animal_life']['F'] -= 1;
			$_SESSION['animal_life']['C1'] -= 1;
			$_SESSION['animal_life']['B1'] -= 1;
			$_SESSION['animal_life']['B2'] -= 1;
			$_SESSION['animal_life']['B3'] -= 1;
			$_SESSION['animal_life']['B4'] -= 1;
			break;
		case "Bunny1":
			$_SESSION['animal_life']['B1'] = 8;
			$_SESSION['animal_life']['C1'] -= 1;
			$_SESSION['animal_life']['C2'] -= 1;
			$_SESSION['animal_life']['F'] -= 1;
			$_SESSION['animal_life']['B2'] -= 1;
			$_SESSION['animal_life']['B3'] -= 1;
			$_SESSION['animal_life']['B4'] -= 1;
			break;
		case "Bunny2":
			$_SESSION['animal_life']['B2'] = 8;
			$_SESSION['animal_life']['C1'] -= 1;
			$_SESSION['animal_life']['C2'] -= 1;
			$_SESSION['animal_life']['B1'] -= 1;
			$_SESSION['animal_life']['F'] -= 1;
			$_SESSION['animal_life']['B3'] -= 1;
			$_SESSION['animal_life']['B4'] -= 1;
			break;
		case "Bunny3":
			$_SESSION['animal_life']['B3'] = 8;
			$_SESSION['animal_life']['C1'] -= 1;
			$_SESSION['animal_life']['C2'] -= 1;
			$_SESSION['animal_life']['B1'] -= 1;
			$_SESSION['animal_life']['B2'] -= 1;
			$_SESSION['animal_life']['F'] -= 1;
			$_SESSION['animal_life']['B4'] -= 1;
			break;
		case "Bunny4":
			$_SESSION['animal_life']['B4'] = 8;
			$_SESSION['animal_life']['C1'] -= 1;
			$_SESSION['animal_life']['C2'] -= 1;
			$_SESSION['animal_life']['B1'] -= 1;
			$_SESSION['animal_life']['B2'] -= 1;
			$_SESSION['animal_life']['B3'] -= 1;
			$_SESSION['animal_life']['F'] -= 1;
			break;
	} 
	
	

	//print_r($_SESSION['animal_life']);
}
//echo $random_animal;
 //print_r($_SESSION['animal_life']);
//  unset($_SESSION['animals']);
//  unset($_SESSION['animal_life']);
// unset($_SESSION['final_result']);



?>