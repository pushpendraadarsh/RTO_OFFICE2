<?php
include '../config/conn.php';
session_start();

if (isset($_POST['users'])) {
    $dealer_id = $_POST['users'];
    $white = $_POST['whiteTape'];
    $yellow = $_POST['yellowTape'];
    $red = $_POST['redTape'];
    $date = date("d-m-Y h:i:s");
    
    $sql = "INSERT INTO dealerfinancialdata (dealer_id,white_tape,yellow_tape,red_tape,method,datetime) VALUES ('$dealer_id','$white','$yellow','$red','add','$date')";
    if (mysqli_query($conn, $sql)){
        echo 200;
    }else{
        echo 300;
    }
}
?>