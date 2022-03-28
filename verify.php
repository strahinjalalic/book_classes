<?php
require('includes/header.php');
require('includes/db_config.php');

if(isset($_GET['activation'])) {
    global $database;

    $update_user = $database->query("UPDATE users SET verified = 'yes' WHERE activation_string = '{$_GET['activation']}'");

?>

<div class='verify_box'>
    <p class="verify_p">Congratulations! You can now login and book your classes!!</p>
</div>

<?php }  ?>