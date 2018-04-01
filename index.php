<?php 

/* Eventually we will get an include file */



require_once 'library/includes.php';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){

    $action = filter_input(INPUT_GET, 'action');

    if($action == NULL){

        $action = 'home';

    }

}

switch ($action) {
    case 'home':
        include 'views/home.php';
        break;

    case 'archive':
        include 'views/archive_new.php';
        break;

    case 'about':
        include 'views/about.php';
        break;

    case 'participate':
        include 'views/participate.php';
        break;

    default: 
        include 'views/home.php';
        break;
}