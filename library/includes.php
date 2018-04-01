<?php
// Create or access a session

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/linkLocal.php';

//Model includes

//Library includes

//classes
require_once $_SERVER['DOCUMENT_ROOT'] .'/library/classes/Post.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/library/classes/model_User.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/library/classes/model_Topic.php';

//Helper classes
require_once $_SERVER['DOCUMENT_ROOT'] .'/library/globals.php';
