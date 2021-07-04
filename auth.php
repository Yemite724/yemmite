<?php
session_start();

/**
 * User Registeration
 * Check for empty fields
 * check if email already exists
 * store user in a session variable
 * @return void
 */
$data = [];
if(isset($_POST['reg_name'])){
    $data = [
        'name' => $_POST['reg_name'],
        'email' => $_POST['reg_email'],
        'pass' => $_POST['reg_password']
    ];

    // check for empty fields
    if($data['name'] !== '' && $data['email'] !== '' && $data['pass'] !== ''){

        // Chexk if user email already exists
        if(userExists($data['email']) == false){
    
            $_SESSION['user'][$data['name']] = $data;
            $_SESSION['message'] = 'Registeration SuccessFul';
            $auth = auth($data['email'], $data['pass']);
            if($auth){
                $_SESSION['id'] = $auth;
                redirect('#/account');
            }
    
        }else{
    
            $_SESSION['message'] = 'Email Already Exist';
            redirect('#/register');
        }
    }
}

/**
 * Login
 */
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $auth = auth($email, $pass);

    if($auth == false){
        $_SESSION['message'] = "Invalid Credentials";
        redirect('#/login');
    }

    $_SESSION['id'] = $auth;
    redirect('#/account');
}

/**
 * Logout
 */
if(isset($_POST['logout'])){
    $_SESSION['id'] = null;
    redirect('#/login');
}


/**
 * Check if email already exists in d session['user]
 */
function userExists($email){
    if(!empty($_SESSION['user'])){

        // Loop through user session
        foreach ($_SESSION['user'] as $user) {
            if($user['email'] == $email){
                return true;
            }
        }

    }
    return false;
}

/**
 * Authenticate user for login
 */
function auth($email, $pass){

    if(!empty($_SESSION['user'])){
        foreach ($_SESSION['user'] as $key => $user) {
            if(
                $email==$user['email']
                &&
                $user['pass'] == $pass
            ){
                return $key;
            }
        }
    }
    return false;
}

/**
 * redirect
 */
function redirect($location)
{
    header('location: '.$location);
    exit;
}