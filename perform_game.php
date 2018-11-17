<?php
session_start();
$final_result_array = isset($_SESSION['final_result_array']) ? $_SESSION['final_result_array'] : [];
$no_of_times_button_clicked = $_POST['button_clicked'];
$animal_person_array = array('Farmer','Cow1','Cow2','Bunny1','Bunny2','Bunny3','Bunny4');

$a = $animal_person_array[array_rand($animal_person_array,1)];

$final_result_array[] = array($no_of_times_button_clicked => $a);

  
  $_SESSION['final_result_array'] = $final_result_array;
//print_r($final_result_array);
  //echo json_encode($final_result_array);
//unset($_SESSION['final_result_array']);




?>