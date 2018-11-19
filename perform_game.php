<?php
session_start();

if (isset($_SESSION['animals']) && isset($_SESSION['animal_life']) && isset($_SESSION['final_result']))
	{
	perform_game_logic();
	}
  else
	{
	$_SESSION['animals'] = array(
		"Farmer",
		"Cow1",
		"Cow2",
		"Bunny1",
		"Bunny2",
		"Bunny3",
		"Bunny4"
	);
	$_SESSION['animal_life'] = array(
		"Farmer" => 15,
		"Cow1" => 10,
		"Cow2" => 10,
		"Bunny1" => 8,
		"Bunny2" => 8,
		"Bunny3" => 8,
		"Bunny4" => 8
	);
	perform_game_logic();
	}

function perform_game_logic()
	{
	$no_of_times_button_clicked = $_POST['button_clicked'];
	$random_animal = $_SESSION['animals'][array_rand($_SESSION['animals'], 1) ];
	$_SESSION['final_result'][] = array(
		$no_of_times_button_clicked => $random_animal
	);
	switch ($random_animal)
		{
	case "Farmer":
		$_SESSION['animal_life']['Farmer'] = 15;
		$_SESSION['animal_life']['Cow1']-= 1;
		$_SESSION['animal_life']['Cow2']-= 1;
		$_SESSION['animal_life']['Bunny1']-= 1;
		$_SESSION['animal_life']['Bunny2']-= 1;
		$_SESSION['animal_life']['Bunny3']-= 1;
		$_SESSION['animal_life']['Bunny4']-= 1;
		break;

	case "Cow1":
		$_SESSION['animal_life']['Farmer']-= 1;
		$_SESSION['animal_life']['Cow1'] = 10;
		$_SESSION['animal_life']['Cow2']-= 1;
		$_SESSION['animal_life']['Bunny1']-= 1;
		$_SESSION['animal_life']['Bunny2']-= 1;
		$_SESSION['animal_life']['Bunny3']-= 1;
		$_SESSION['animal_life']['Bunny4']-= 1;
		break;

	case "Cow2":
		$_SESSION['animal_life']['Farmer']-= 1;
		$_SESSION['animal_life']['Cow1']-= 1;
		$_SESSION['animal_life']['Cow2'] = 10;
		$_SESSION['animal_life']['Bunny1']-= 1;
		$_SESSION['animal_life']['Bunny2']-= 1;
		$_SESSION['animal_life']['Bunny3']-= 1;
		$_SESSION['animal_life']['Bunny4']-= 1;
		break;

	case "Bunny1":
		$_SESSION['animal_life']['Farmer']-= 1;
		$_SESSION['animal_life']['Cow1']-= 1;
		$_SESSION['animal_life']['Cow2']-= 1;
		$_SESSION['animal_life']['Bunny1'] = 8;
		$_SESSION['animal_life']['Bunny2']-= 1;
		$_SESSION['animal_life']['Bunny3']-= 1;
		$_SESSION['animal_life']['Bunny4']-= 1;
		break;

	case "Bunny2":
		$_SESSION['animal_life']['Farmer']-= 1;
		$_SESSION['animal_life']['Cow1']-= 1;
		$_SESSION['animal_life']['Cow2']-= 1;
		$_SESSION['animal_life']['Bunny1']-= 1;
		$_SESSION['animal_life']['Bunny2'] = 8;
		$_SESSION['animal_life']['Bunny3']-= 1;
		$_SESSION['animal_life']['Bunny4']-= 1;
		break;

	case "Bunny3":
		$_SESSION['animal_life']['Farmer']-= 1;
		$_SESSION['animal_life']['Cow1']-= 1;
		$_SESSION['animal_life']['Cow2']-= 1;
		$_SESSION['animal_life']['Bunny1']-= 1;
		$_SESSION['animal_life']['Bunny2']-= 1;
		$_SESSION['animal_life']['Bunny3'] = 8;
		$_SESSION['animal_life']['Bunny4']-= 1;
		break;

	case "Bunny4":
		$_SESSION['animal_life']['Farmer']-= 1;
		$_SESSION['animal_life']['Cow1']-= 1;
		$_SESSION['animal_life']['Cow2']-= 1;
		$_SESSION['animal_life']['Bunny1']-= 1;
		$_SESSION['animal_life']['Bunny2']-= 1;
		$_SESSION['animal_life']['Bunny3']-= 1;
		$_SESSION['animal_life']['Bunny4'] = 8;
		break;
		}

		$count_total_animals = count($_SESSION['animals']);
	foreach($_SESSION['animal_life'] as $key => $value)
		{
		if ($value == '0')
			{
			if ($key == 'Farmer')
				{
				$msg = "Farmer Died ! You Lose !";
				unset($_SESSION['animals']);
				unset($_SESSION['animal_life']);
				unset($_SESSION['final_result']);
				break;
				}

			$search_animal = array_search($key, $_SESSION['animals']);
			unset($_SESSION['animals'][$search_animal]);
			
			}
			$check_animals_left = count($_SESSION['animals']);
			if($check_animals_left < $count_total_animals)
			{
				$msg = "Hard Luck ! One or Some animal(s) died.";
			}
		}

	if ($no_of_times_button_clicked == '50')
		{
		$counter = 0;
		if (in_array('Farmer', $_SESSION['animals']))
			{
			$counter++;
			}

		if (in_array('Cow1', $_SESSION['animals']) || in_array('Cow2', $_SESSION['animals']))
			{
			$counter++;
			}

		if (in_array('Bunny1', $_SESSION['animals']) || in_array('Bunny2', $_SESSION['animals']) || in_array('Bunny3', $_SESSION['animals']) || in_array('Bunny4', $_SESSION['animals']))
			{
			$counter++;
			}

		if ($counter == 3)
			{
			$msg = "Maximum Clicks Reached. You Won !";
			unset($_SESSION['animals']);
			unset($_SESSION['animal_life']);
			unset($_SESSION['final_result']);
			}
		  else
			{
			$msg = "Maximum Clicks Reached. You Lose !";
			unset($_SESSION['animals']);
			unset($_SESSION['animal_life']);
			unset($_SESSION['final_result']);
			}
		}

	if ($msg)
		{
		echo json_encode($msg);		
		}
	}
?>