<?php
session_start();
/* session is started and checked if already something is there in the session after each click */

if (isset($_SESSION['animals']) && isset($_SESSION['animal_life']) && isset($_SESSION['final_result'])) {
    perform_game_logic();
} else {
    $_SESSION['animals']     = array(
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

/* Below is the function where actual logic of gameplay takes place */

function perform_game_logic()
{
    $no_of_times_button_clicked = (isset($_POST['button_clicked']) ? $_POST['button_clicked'] : '');
    $random_animal              = $_SESSION['animals'][array_rand($_SESSION['animals'], 1)];
    $_SESSION['final_result']   = (isset($_SESSION['final_result']) ? $_SESSION['final_result'] : '');
    $_SESSION['final_result'] .= $no_of_times_button_clicked . " => " . $random_animal . ","; //chosen randomly one animal and kept in session as a string which will be useful to show in which round which animal fed.
    /* below is the code to set initial life of the random animal selected and to do -1 from other animals which are not selected for each click  */
    switch ($random_animal) {
        case "Farmer":
            $_SESSION['animal_life']['Farmer'] = 15;
            $_SESSION['animal_life']['Cow1'] -= 1;
            $_SESSION['animal_life']['Cow2'] -= 1;
            $_SESSION['animal_life']['Bunny1'] -= 1;
            $_SESSION['animal_life']['Bunny2'] -= 1;
            $_SESSION['animal_life']['Bunny3'] -= 1;
            $_SESSION['animal_life']['Bunny4'] -= 1;
            break;
        
        case "Cow1":
            $_SESSION['animal_life']['Farmer'] -= 1;
            $_SESSION['animal_life']['Cow1'] = 10;
            $_SESSION['animal_life']['Cow2'] -= 1;
            $_SESSION['animal_life']['Bunny1'] -= 1;
            $_SESSION['animal_life']['Bunny2'] -= 1;
            $_SESSION['animal_life']['Bunny3'] -= 1;
            $_SESSION['animal_life']['Bunny4'] -= 1;
            break;
        
        case "Cow2":
            $_SESSION['animal_life']['Farmer'] -= 1;
            $_SESSION['animal_life']['Cow1'] -= 1;
            $_SESSION['animal_life']['Cow2'] = 10;
            $_SESSION['animal_life']['Bunny1'] -= 1;
            $_SESSION['animal_life']['Bunny2'] -= 1;
            $_SESSION['animal_life']['Bunny3'] -= 1;
            $_SESSION['animal_life']['Bunny4'] -= 1;
            break;
        
        case "Bunny1":
            $_SESSION['animal_life']['Farmer'] -= 1;
            $_SESSION['animal_life']['Cow1'] -= 1;
            $_SESSION['animal_life']['Cow2'] -= 1;
            $_SESSION['animal_life']['Bunny1'] = 8;
            $_SESSION['animal_life']['Bunny2'] -= 1;
            $_SESSION['animal_life']['Bunny3'] -= 1;
            $_SESSION['animal_life']['Bunny4'] -= 1;
            break;
        
        case "Bunny2":
            $_SESSION['animal_life']['Farmer'] -= 1;
            $_SESSION['animal_life']['Cow1'] -= 1;
            $_SESSION['animal_life']['Cow2'] -= 1;
            $_SESSION['animal_life']['Bunny1'] -= 1;
            $_SESSION['animal_life']['Bunny2'] = 8;
            $_SESSION['animal_life']['Bunny3'] -= 1;
            $_SESSION['animal_life']['Bunny4'] -= 1;
            break;
        
        case "Bunny3":
            $_SESSION['animal_life']['Farmer'] -= 1;
            $_SESSION['animal_life']['Cow1'] -= 1;
            $_SESSION['animal_life']['Cow2'] -= 1;
            $_SESSION['animal_life']['Bunny1'] -= 1;
            $_SESSION['animal_life']['Bunny2'] -= 1;
            $_SESSION['animal_life']['Bunny3'] = 8;
            $_SESSION['animal_life']['Bunny4'] -= 1;
            break;
        
        case "Bunny4":
            $_SESSION['animal_life']['Farmer'] -= 1;
            $_SESSION['animal_life']['Cow1'] -= 1;
            $_SESSION['animal_life']['Cow2'] -= 1;
            $_SESSION['animal_life']['Bunny1'] -= 1;
            $_SESSION['animal_life']['Bunny2'] -= 1;
            $_SESSION['animal_life']['Bunny3'] -= 1;
            $_SESSION['animal_life']['Bunny4'] = 8;
            break;
    }
    
    /* Below is the code for the conditions as per the game */
    $count_total_animals = count($_SESSION['animals']);
    foreach ($_SESSION['animal_life'] as $key => $value) {
        if ($value == '0') {
            if ($key == 'Farmer') //checking animals life array if the value of farmer found 0 then game needs to be stopped and unset all sessions to start a new game.
                {
                $msg = "FARMER_DEAD_LOSE";
                unset($_SESSION['animals']);
                unset($_SESSION['animal_life']);
                break;
            }
            
            $search_animal = array_search($key, $_SESSION['animals']);
            unset($_SESSION['animals'][$search_animal]);
        }
        
        $check_animals_left = count($_SESSION['animals']); // this below code is written to alert user whenever his/her animal dies during the gameplay.
        if ($check_animals_left < $count_total_animals) {
            $msg = "HARD_LUCK_DIED";
        }
    }
    
    /* Below is the code for checking if the button click reached 50, if yes then check for win/loss conditions as per the game criteria */
    if ($no_of_times_button_clicked == '50') {
        $counter = 0;
        if (in_array('Farmer', $_SESSION['animals'])) {
            $counter++;
        }
        
        if (in_array('Cow1', $_SESSION['animals']) || in_array('Cow2', $_SESSION['animals'])) {
            $counter++;
        }
        
        if (in_array('Bunny1', $_SESSION['animals']) || in_array('Bunny2', $_SESSION['animals']) || in_array('Bunny3', $_SESSION['animals']) || in_array('Bunny4', $_SESSION['animals'])) {
            $counter++;
        }
        
        if ($counter == 3) {
            $msg = "MAX_CLICK_WON";
            unset($_SESSION['animals']);
            unset($_SESSION['animal_life']);
        } else {
            $msg = "MAX_CLICK_LOSE";
            unset($_SESSION['animals']);
            unset($_SESSION['animal_life']);
        }
    }
    
    if (isset($msg)) {
        echo json_encode($msg); // this is a consolidated ajax response code to run when response needs to be send to the ajax call
    }
}

/* below is the code when ajax call made to get the results by clicking the get results button */
$result_request = (isset($_POST['get_results']) ? $_POST['get_results'] : '');

if ($result_request == 'true') {
    $result             = rtrim($_SESSION['final_result'], ",");
    $final_result_array = explode(",", $result);
    echo json_encode($final_result_array);
}

/* below is the code when ajax call made to end the game and unset the result session */
$end_result_session = (isset($_POST['end_result_session']) ? $_POST['end_result_session'] : '');

if ($end_result_session == 'true') {
    unset($_SESSION['final_result']);
    echo json_encode("Game Ended");
}

/* below is  the code for making animals red in animals bar where array_diff function is used to check which animals are left and which are died and that will be shown accordingly in the animals bar */
$check_animals = (isset($_POST['check_animals']) ? $_POST['check_animals'] : '');

if ($check_animals == 'true') {
    $game_animals = array(
        "Farmer",
        "Cow1",
        "Cow2",
        "Bunny1",
        "Bunny2",
        "Bunny3",
        "Bunny4"
    );
    $resultant    = array_diff($game_animals, $_SESSION['animals']);
    echo json_encode($resultant);
}

?>