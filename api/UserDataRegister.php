<?php
include_once '../config/conn.php';
session_start();
if (isset($_SESSION['dealerId']) && isset($_POST['customerName'])) {
    $dealerId = $_SESSION['dealerId'];
    /*************Certificate No Allot************ */
    $sql= "SELECT * FROM dealerclientdata ORDER BY certificateno DESC";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 if (mysqli_num_rows($result) > 0) {
 if (intval($row['certificateno']) < 1000) {
     $last_CertNo = 1000;
}else{
    $last_CertNo = $row['certificateno'];
}
}else{
$last_CertNo = 1000;
}
    $certNooo = intval($last_CertNo) + 1;
    $timesofzero = 8 - strlen($certNooo);
    $certNo = str_repeat("0",$timesofzero).$certNooo;


    $name = $_POST['customerName'];
    $mobNo = $_POST['contactNumber'];
    $address = $_POST['address'];
    $vehicalMake = $_POST['make'];
    $model = $_POST['model'];
    $vehicalregistrationno = $_POST['registrationNo'];
    $chasisno = $_POST['chasisNo'];
    $engineno = $_POST['engineNo'];
    $vehicalregisdate = $_POST['vehicalregisdate'];
    $vehicalmanufactureyear = $_POST['manufacturingYear'];
    $vecicalmodelYr = $_POST['vecicalmodelYr'];
    $placeFitment = $_POST['placeFitment'];
    $white_tape = $_POST['white_tape'];
    $yellow_tape = $_POST['yellow_tape'];
    $red_tape = $_POST['red_tape'];
    $invoiceno = $_POST['invoiceNo'];
    $invoicedate = $_POST['invoiceDate'];
    $extensions= array("jpeg","jpg","png");
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    $image4 = $_FILES['image4']['name'];
    
    if ($_FILES['image1']['tmp_name'] == "") {
        $image1Path = '';
    } else{
        $image1PathTmp = $_FILES['image1']['tmp_name'];
        $image1Paths= strtolower(pathinfo($image1,PATHINFO_EXTENSION));
        if(in_array($image1Paths,$extensions)=== false){
            
        }else{
            $image1PathName = $certNo."(1).".$image1Paths;
            $image1Pathy = "../images/rtoImage/". $image1PathName;
            if (move_uploaded_file($image1PathTmp,$image1Pathy)) {
                $image1Path = $image1PathName;
            }else{
                $image1Path = '';
            }
        }
    } 
    if ($_FILES['image2']['tmp_name'] == "") {
        $image2Path = '';
    } else{
        $image2PathTmp = $_FILES['image2']['tmp_name'];
        $image2Paths= strtolower(pathinfo($image2,PATHINFO_EXTENSION));
        if(in_array($image2Paths,$extensions)=== false){
            
        }else{
            $image2PathName = $certNo."(2).".$image2Paths;
            $image2Pathy = "../images/rtoImage/". $image2PathName;
            if (move_uploaded_file($image2PathTmp,$image2Pathy)) {
                $image2Path = $image2PathName;
            }else{
                $image2Path = '';
            }
        }
    } 
    if ($_FILES['image3']['tmp_name'] == "") {
        $image3Path = '';
    } else{
        $image3PathTmp = $_FILES['image3']['tmp_name'];
        $image3Paths= strtolower(pathinfo($image3,PATHINFO_EXTENSION));
        if(in_array($image3Paths,$extensions)=== false){
            
        }else{
            $image3PathName = $certNo."(3).".$image3Paths;
            $image3Pathy = "../images/rtoImage/". $image3PathName;
            if (move_uploaded_file($image3PathTmp,$image3Pathy)) {
                $image3Path = $image3PathName;
            }else{
                $image3Path = '';
            }
        }
    }
    if ($_FILES['image4']['tmp_name'] == "") {
        $image4Path = '';
    }else {
        $image4PathTmp = $_FILES['image4']['tmp_name'];
        $image4Paths= strtolower(pathinfo($image4,PATHINFO_EXTENSION));
        if(in_array($image4Paths,$extensions)=== false){
            
        }else{
            $image4PathName = $certNo."(4).".$image4Paths;
            $image4Pathy = "../images/rtoImage/". $image4PathName;
            if (move_uploaded_file($image4PathTmp,$image4Pathy)) {
                $image4Path = $image4PathName;
            }else{
                $image4Path = '';
            }
        }
    }
    ////////////////////////////////////
    // $file_name = $_FILES['reciept']['name'];
    // $file_size = $_FILES['reciept']['size'];
    // $file_tmp = $_FILES['reciept']['tmp_name'];
    // $file_type = $_FILES['reciept']['type'];
    // $file_ext= strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    // $extensions= array("jpeg","jpg","png");
    ////////////////////////////////// 
    
    
    $rtostate = $_POST['state'];
    $rto = $_POST['selectRTO'];
    $datetime = date("d-m-Y h:i:s");

    $sql2 = "SELECT SUM(red_tape) as redTape , SUM(white_tape) as whiteTape , SUM(yellow_tape) as yellowTape FROM dealerfinancialdata WHERE dealer_id = '$dealerId'";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    if (intval($row2['redTape']) < intval($red_tape) || intval($row2['whiteTape']) < intval($white_tape) || intval($row2['yellowTape']) < intval($yellow_tape)) {
        $myObj = ["status"=>100];
    }else{
    $sql = "INSERT INTO dealerclientdata (`dealer_id`, `certificateno`, `name`, `address`, `mobno`, `vehicalregistrationno`,
     `vehicalmanufactureyear`, `vehicalregistrationdate`, `chasisno`, `engineno`, `make`, `model`, `white_tape`, 
     `yellow_tape`, `red_tape`, `modelno`, `modelyear`, `invoiceno`, `invoicedate`, `rtostate`, `rto`, `image1`, 
     `image2`, `image3`, `image4`, `status`, `datetime`)
    VALUES ('$dealerId','$certNo','$name','$address','$mobNo','$vehicalregistrationno','$vehicalmanufactureyear',
    '$vehicalregisdate','$chasisno','$engineno','$vehicalMake',
    '$model','$white_tape','$yellow_tape','$red_tape','','$vecicalmodelYr','$invoiceno',
    '$invoicedate','$rtostate','$rto','$image1Path','$image2Path','$image3Path','$image4Path','active','$datetime')";
    
    $usedw = '-'.intval($white_tape);
    $usedy = '-'.intval($yellow_tape);
    $usedr = '-'.intval($red_tape);
    $sql2 = "INSERT INTO dealerfinancialdata (dealer_id,certificateno,white_tape,yellow_tape,red_tape,method,datetime)
    VALUES ('$dealerId','$certNo','$usedw','$usedy','$usedr','used','$datetime')";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        $myObj = ["status"=>200,"no"=>$certNo];
    }else{
        $myObj = ["status"=>300];
    }
}
echo json_encode($myObj);
}
?>