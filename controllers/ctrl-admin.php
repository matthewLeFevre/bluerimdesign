<?php 

/* Eventually we will get an include file */

require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){

    $action = filter_input(INPUT_GET, 'action');

    if($action == NULL){

        $action = 'home';

    }

}

switch ($action) {
    case 'admin':
        $posts = $postService->getVariable(4);
        $topics = $topicService->getAll();
        include $_SERVER['DOCUMENT_ROOT'] . '/views/admin/admin-dashboard.php';
        break;

    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/views/home.php';
        break;
}