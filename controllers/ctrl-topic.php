<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){

    $action = filter_input(INPUT_GET, 'action');

    if($action == NULL){

        $action = 'home';

    }

}

switch ($action) {

    case 'topic_process':

        // Topic form input

        $topicName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        break;

    case 'topic_delete':

        // TOPIC iD
        
        $topicId = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_NUMBER_INT);
        break;

    default: 
        include 'views/home.php';
        break;
}