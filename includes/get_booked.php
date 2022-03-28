<?php
include('functions.php');

$times = get_booked($_POST['date'], $_POST['teacher']);
foreach($times as $time) {
    $split = explode(':', $time);
    echo $split[0] . $split[1] . ",";
}
