<?php

include('db_config.php');
require_once 'vendor/autoload.php';

use Omnipay\Omnipay;

function set_message($msg) {
    if(!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = '';
    }
}

function get_teachers() {
    global $database;

    $get_teachers = $database->query("SELECT * FROM users WHERE role_id = '3'");
    while($row = mysqli_fetch_array($get_teachers)) {
        $option = <<<DELIMITER
         <option value={$row['id']}>{$row['name']}</option>
        DELIMITER;
        echo $option;
    }
}

function get_booked($date, $teacher) {
    global $database;

    $data = array();

    $get_booked_classes = $database->query("SELECT * FROM booked_classes WHERE date='{$date}' AND teacher_id='{$teacher}'");
    while($row = mysqli_fetch_array($get_booked_classes)) {
        array_push($data, $row['time']);
    }

    return $data;
}

// function paypal_transaction() {
//     global $database;

//     define('CLIENT_ID', 'Afb_L-3yv1A9-bGaxpi735boLni7AfCoA6KiZY5mIUx-DVh5X2iOG28aUtUr2hYrP-YH4lVMBbmkIjBW');
//     define('CLIENT_SECRET', 'EJ2vomyN5OwrXIBDA_la-wh-PwYsMSs-5v0YVSjlt5ToSaq8jiEiHT94sj3V-J4QzKs68gaXSM8BiHO4');

//     define('PAYPAL_RETURN_URL', 'http://localhost/book_classes/success.php');
//     define('PAYPAL_CANCEL_URL', 'http://localhost/book_classes/cancel.php');
//     define('PAYPAL_CURRENCY', 'USD');    

//     $gateway = Omnipay::create('PayPal_Express');
//     $gateway->setUsername("sb-7j4hl606677@personal.example.com");
//     $gateway->setPassword("ARySNgUCvyU9tEBp-zsd0WbbNO_7Nxxxxoi3xxxxh2cTuDxRh7xxxxVu9W5ZkIBGYqjqfzHrjY3wta");
//     $gateway->setSignature("EOEwezsNWMWQM63xxxxxknr8QLoAOoC6lD_-kFqjgKxxxxxwGWIvsJO6vP3syd10xspKbx7LgurYNt9");
//     $gateway->setTestMode(true);
//     return $gateway;
// }