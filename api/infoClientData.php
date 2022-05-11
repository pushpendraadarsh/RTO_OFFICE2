<?php
include_once '../config/conn.php';
session_start();
if (isset($_SESSION['dealerId']) && isset($_POST['certificateNo'])) {
    $dealerId = $_SESSION['dealerId'];
    $certificateNo = $_POST['certificateNo'];
    $sql = "SELECT * FROM dealerclientdata WHERE dealer_id='$dealerId' && certificateno='$certificateNo'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $status = 200;
        $row = mysqli_fetch_assoc($result);
        $invoiceDate = $row['invoicedate'];
        $invoicedate = date("d-m-Y", strtotime($invoiceDate));
        $NextInvoicedate = adddate($invoicedate,"1 year");
        $fullname = $row['name'];
        $address = $row['address'];
        $vehiNoChasiNoEngineNo = $row['vehicalregistrationno'].'/'.$row['chasisno'].'/'.$row['engineno'];
        $WhitYelloRedTape= $row['white_tape'].'/'.$row['yellow_tape'].'/'.$row['red_tape'];
        $vehiRegisDateMfgYrModelYr= $row['vehicalregistrationdate'].'/'.$row['vehicalmanufactureyear'].'/'.$row['modelyear'];
        $placeRto = $row['rtostate'].'/'.$row['rto'];
    }else{
        $status = 300;
    }
    $obj = array("status"=>$status,
                 "generatedDate"=>$invoicedate,
                 "nextRenewal"=>$NextInvoicedate,
                 "name"=>$fullname,
                 "address"=>$address,
                 "vehiNoChasiNoEngineNo"=>$vehiNoChasiNoEngineNo,
                 "WhitYelloRedTape"=>$WhitYelloRedTape,
                 "vehiRegisDateMfgYrModelYr"=>$vehiRegisDateMfgYrModelYr,
                 "placeRto"=>$placeRto
                );
    echo json_encode($obj);
}
?>