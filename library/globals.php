<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';
date_default_timezone_set("America/Denver");
$currentDate = date("Y-m-d h:i:sa");
$postService = new Post_Service();
$userService = new User_Service();
$topicService= new Topic_Service();