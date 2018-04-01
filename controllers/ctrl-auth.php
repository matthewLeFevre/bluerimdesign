<?php 

// Includes all objects and services
require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';

// Semi Global veriable that works as a query string to load pages
$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');

  if($action == NULL){
    $action = 'login_view';
  }
}

// Redirects user based on query string sent to action

switch ($action) {

    // Renders the login view

    case 'login_view':
        include $_SERVER['DOCUMENT_ROOT'] .'/views/auth/auth-login.php';
        break;

    case 'login_process':

        // paths based on user status

        $userPath = 'Location: /index.php?action=home';
        $modrPath = 'Location: /controllers/ctrl-admin.php?action=admin';
        $admnPath = 'Location: /controllers/ctrl-admin.php?action=admin';

        // We are retrieving the inputs that we need and applying logic
        //Inputs from login form

        $userIdentity = filter_input(INPUT_POST, 'userIdentity');
        $userPass = filter_input(INPUT_POST, 'password');
        $infoArr  = array('userIdentity'=> $userIdentity,'password'=> $userPass);

        // Applying business Logic

        $result = $userService->login($infoArr);

        // Redirecting user based on Status

        switch($result['status']) {
            case "user":
                header($userPath);
                break;
            case "moderator":
                header($modrPath);
                break;
            case "admin":
                header($admnPath);
                break;
            case "error":
            
                // Send the appropriate error message
                // to the front end
                echo json_encode($result);
                break;
        }
        break;

    case 'logout_process':
        session_destroy();
        header('location: /index.php');
        break;

    case 'register_view':
        include $_SERVER['DOCUMENT_ROOT'] .'/views/auth/auth-register.php';
        break;

    case 'register_process':

        // Register Form Inputs

        $userEmail = filter_input(INPUT_POST, 'email');
        $userPass  = filter_input(INPUT_POST, 'password');
        $userName  = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $userFirst = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $userLast  = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $infoArr   = array( "email"     => $userEmail,
                            "password"  => $userPass,
                            "name"      => $userName,
                            "firstname" => $userFirst,
                            "lastname"  => $userLast);

        // Register Form Logic

        $newUser = new User("register", $infoArr);

        // If a status is assigned
        // Throw the error
        if($newUser->errStatus) {
            echo json_encode($newUser->$errStatus);
            break;
        }

        $result = $newUser->register();

        // success failure alerts

        if($result) {

        // on success reroute to log user in

            header('location: /controllers/ctrl-auth.php?action=login_view');
        } else {

        // on failure send  alert

            echo "<h1>error</h1>";
        }
        break;

    default: 
        include $_SERVER['DOCUMENT_ROOT'] .'/views/auth/auth-login.php';
        break;
}