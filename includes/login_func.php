<?php
//include 'db_config.php';

if(isset($_POST['login'])) {
    global $database;

    $login_errors = array();
    $email = trim($_POST['email_login']);
    $password = $_POST['password_login'];


    if(empty(trim($_POST['email_login'])) || empty($_POST['password_login'])) {
        array_push($login_errors, "Please fill out both fields.");
    } else {

    $get_user = $database->query("SELECT * FROM users WHERE email = '{$email}'");
    if($user = mysqli_fetch_array($get_user)) {
        if($user['verified'] == 'yes') {
            $verify_pass = password_verify($password, $user['password']);

            if($verify_pass) {
                $_SESSION['user'] = $user['name'];
                $_SESSION['u_id'] = $user['id'];


                $user['role_id'] == 1 ? header("Location: dashboard.php") : ($user['role_id'] == 2 ? header("Location: admin-dash.php") : header("Location: teacher-dash.php"));
            } else {
                array_push($login_errors, "Email or password is incorrect.");
            }

        } else {
            array_push($login_errors, "You need to verify your account first.");
        }
    } else {
        array_push($login_errors, "Email or password is incorrect.");
    }
}
}