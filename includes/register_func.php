<?php 
require 'functions.php';
require 'vendor/autoload.php';
use Mailgun\Mailgun;

if(isset($_POST['register'])) {
        global $database;
    
        $reg_errors = array();
        $errors = array();

        $name = trim($_POST['user_name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if(empty($name)  || empty($email) || empty($password) || empty($confirm_password)) {
            array_push($reg_errors, "Please fill out all fields.");
            $errors[] = 'Please fill out all fields.';
        }

        if(strlen($name) < 2) {
            array_push($reg_errors, "Please enter valid name.");
            $errors[] = 'Please enter valid name.';
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($reg_errors, "Enter valid e-mail address.");
            $errors[] = 'Enter valid e-mail address.';
        }

        $check_email_exist_query = $database->query("SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($check_email_exist_query) == 1) {
            array_push($reg_errors, "E-mail already exists.");
            $errors[] = 'E-mail already exists.';
        }

        if(strlen($password) < 8) {
            array_push($reg_errors, "Password need to have at least 8 characters.");
            $errors[] = 'Password need to have at least 8 characters.';
        }

        if($password != $confirm_password) {
            array_push($reg_errors, "Passwords needs to match.");
            $errors[] = 'Passwords needs to match.';
        } 

        if(empty($reg_errors) && empty($errors)) {
            $activation_string = substr(str_shuffle(MD5(microtime())), 0, 30);
            $hashed_pasword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
            $insert_user = $database->query("INSERT INTO users(name, email, password, role_id, verified, activation_string) VALUES('{$name}', '{$email}', '{$hashed_pasword}', '1', 'no', '{$activation_string}')");
            $success_msg = "Registration almost done! Check your e-mail in order to complete your verification";

            $act_link = '<a href="http://localhost/book_classes/verify.php?activation=' . $activation_string .'" itemprop="url">http://localhost/book_classes/verify.php?activation='.$activation_string.'</a>';

            $mg = Mailgun::create('e9aa8e4b39012886b8872a9284b38781-bbbc8336-d8979d87');

            $mg->messages()->send('sandbox78b00f964c9940eeafebeed63f8d3c85.mailgun.org', [
                'from'    => 'engLearn kiddo@sandbox78b00f964c9940eeafebeed63f8d3c85.mailgun.org',
                'to'      => $email,
                'subject' => 'Account activation e-mail!',
                'o:tracking' => 'off',
                'o:tracking-clicks' => 'off',
                'o:tracking-opens' => 'off',
                'html' => '<html><body>Hello ' . $name . '! In order to verify your account you need to click on following ' . $act_link . ' <br /> Also, by verifying your account, you will get coupon for ONE FREE CLASS! <br /> You can enter it in application!</body><html>',
        ]);
    } 
}    