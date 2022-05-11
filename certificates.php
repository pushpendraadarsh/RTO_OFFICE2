<?php
require('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
include 'config/conn.php';
session_start();
if (isset($_SESSION['dealerId']) && isset($_GET['certificateNo'])) {
    /***********************Constant data**************************** */
    $dealerId = $_SESSION['dealerId'];
    $OrganizationName = "SYN AUTO SOLUTIONS PVT. LTD.";
    $OrganizationAddress = "STREET NO. 11,KADIPUR INDUSTRIAL AREA,GURUGRAM,HARYANA-122001";
    $OrganizationEmail = "synautosolutionspvt.ltd@gmail.com";
    $LogoPath = "images/logo.png";
    /***************** Select data from MySQL database******************/
$certificateNo = $_GET['certificateNo'];
$select = "SELECT * FROM dealerclientdata WHERE dealer_id='$dealerId' && certificateno='$certificateNo'";
$result = $conn->query($select);
$select2 = "SELECT * FROM dealerdemographicdata WHERE dealer_id='$dealerId'";
$result2 = $conn->query($select2);
if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result2) > 0) {
$row = mysqli_fetch_assoc($result);
$row2 = mysqli_fetch_assoc($result2);

/*********Customer Data************/
$cusName = strtoupper($row['name']);
$cusContact = strtoupper($row['mobno']);
$cusAddress = strtoupper($row['address']);
$invoiceDatePre = $row['invoicedate'];
$invoiceDate = date("d-m-Y", strtotime($invoiceDatePre));
$invoiceno_date = $row['invoiceno'].'/'.$invoiceDate;
$invoiceDateAft1YrsPending =  adddate($invoiceDate,"1 year");
$invoiceDateAft1Yrs = substract_date($invoiceDateAft1YrsPending,"1 days");
$vehicalNo = strtoupper($row['vehicalregistrationno']);
$make = strtoupper($row['make']);
$makeModel = strtoupper($row['model']);
$vehicalmanufactureyear = $row['vehicalmanufactureyear'];
$engineno = strtoupper($row['engineno']);
$chasisno = strtoupper($row['chasisno']);
$rto = strtoupper($row['rto'].'/'.$row['rtostate']);
/***************dealer Data****************** */
$dealerName = strtoupper($row2['firstName'].' '.$row2['lastName']);
$dealerAddress = strtoupper($row2['address']);
/****************************QR DATA ASSETS***************************** */
$codeText = 'Mfg by : SYN AUTO SOLUTIONS PVT. LTD. | Installed by : '.$dealerName.' | Certificate No.: '.$certificateNo.' |  Fitment Date : '.$invoiceDate.' | Renewal Date : '.$invoiceDateAft1Yrs.'| Owner Name : '.$cusName.' | Make : '.$make.' | Model : '.$makeModel.' | Vehicle No. : '.$vehicalNo.' 
| Engine No. : '.$engineno.' | Chasis No.: '.$chasisno.' | TAC No.: CK 6129 | Invoice No.: '.$invoiceno_date;
    QRcode::png($codeText,'006_L.png');
    $qr = '006_L.png';
    
    $codeText2 = 'Approval Soon';
    QRcode::png($codeText2,'007_L.png');
$qrDefault = '007_L.png';
/************************************************************************************************************/
//page border
//Cell(width , height , text , border , end line , [align] )
// $pdf->Image('images/pd.jpg',-0.5,-1.5,211,303);
$pdf->Image($qr,9,5,32,32);
$pdf->Image($LogoPath,87.5,6,34.5,23);
$pdf->SetFont('Arial','b',8);
$pdf->Image($qrDefault,167.9,10,34,34);
$pdf->Text(166.5,11,"Scan for print approvals");
$pdf->SetFont('Arial','B',12);
$pdf->setXY(69.5,29);
$pdf->Cell(80,5,$OrganizationName,0,1);
$pdf->SetFont('Arial','B',8);
$pdf->setXY(78.2,33);
$pdf->Cell(60,5,'AN ISO Certified Company 9001 : 2015',0,1);
$pdf->setXY(51.9,37);
$pdf->Cell(60,5,'STREET NO. 11,KADIPUR INDUSTRIAL AREA,GURUGRAM,HARYANA-122001',0,1);
$pdf->setXY(75.1,41);
$pdf->Cell(50,5,'Email: '.$OrganizationEmail,0,1);
$pdf->setXY(10,48);
$pdf->SetFont('Arial','BU',14);
$pdf->SetTextColor(8,40,117);
$pdf->Cell(150,6,'AUTHORIZATION CERTIFICATE - RETRO REFLECTIVE TAPE',0,1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->setXY(10,58.4);
$pdf->Cell(190,5,'Certificate Serial No.: '.$certificateNo,0,1,'R');
$pdf->Cell(190,7.5,'Date: '.$invoiceDate,0,1,'R');
$pdf->SetFont('Arial','',9);

$pdf->Cell(190,5,'This is to certify that '.$dealerName,0,1,'L');
$pdf->Cell(190,6,'Office address is '.$dealerAddress,0,1,'L');
$pdf->Cell(190,6,'is authorised for the state of JHARKHAND for Vehicle Conspicuity Products as per AIS-090',0,1,'L');
$pdf->Cell(190,6,'We have supplied.',0,1,'L');
$pdf->Cell(190,6,'(approved by ICAT under AIS-090 to the said SUB DEALER)',0,1,'L');
$pdf->Cell(190,6,'',0,1,'');//blank space
$pdf->Cell(190,6,'___________________',0,1,'R');
$pdf->Cell(190,1.8,'Authorize Signatory',0,1,'R');
$pdf->SetFont('Arial','BU',14);
$pdf->SetTextColor(8,40,117);
$pdf->Cell(190,2.9,'',0,1,'');//blank space
$pdf->Cell(150,4.9,'SUPPLY INSTALLATION CERTIFICATE',0,1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','BU',9);
$pdf->Cell(190,2.9,'',0,1,'');//blank space
$pdf->Cell(150,5,'VEHICLE DETAILS',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,6.8,'Vehicle Make : '.$make,0,0);
$pdf->Cell(90,6.8,'Vehicle Registration Number : '.$vehicalNo,0,1,'R');
$pdf->Cell(90,6,'Registration Date : '.date("d-m-Y", strtotime($row['vehicalregistrationdate'])),0,0,'l');
$pdf->Cell(100,6,'Date of mfg. Year : '.$vehicalmanufactureyear,0,1,'R');
$pdf->Cell(90,6,'Chassis Number : '.$chasisno,0,0,'l');
$pdf->Cell(100,6,'Engine Number : '.$engineno,0,1,'R');
$pdf->Cell(90,6,'Vehicle Model : '.$makeModel,0,0,'l');
$pdf->SetFont('Arial','BU',9);
$pdf->Cell(190,8,'',0,1);//blank space
$pdf->Cell(150,6,'VEHICLE OWNER DETAILS',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,6.8,'Owner Name : '.$cusName,0,0);
$pdf->Cell(90,6.8,'Owner Mobile : '.strtoupper($row['mobno']),0,1,'R');
$pdf->Cell(90,6,'Owner Address: '.$cusAddress,0,0,'l');
$pdf->SetFont('Arial','BU',9);
$pdf->Cell(190,8,'',0,1);//blank space
$pdf->Cell(150,6,'RRT APPLICATION DETAILS',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(100,6.8,'Front Side(White RRT Tape) : '.strtoupper($row['white_tape']).' METRE',0,1);
$pdf->Cell(90,6.8,'Sides(Yellow RRT Tape) : '.strtoupper($row['yellow_tape']).' METRE',0,1,'l');
$pdf->Cell(90,6.8,'Rear(Red RRT Tape) : '.strtoupper($row['red_tape']).' METRE',0,1,'l');
$pdf->SetFont('Arial','BU',9);
$pdf->Cell(190,3,'',0,1);//blank space
$pdf->Cell(150,6,'FITMENT IMAGES',0,1);
if ($row['image1'] == "") {
    $pdf->Image('images/noImageAvailable.png',11,211,40,40);
}else{
    $pdf->Image('images/rtoImage/'.$row['image1'],11,211,40,40);
}
if ($row['image2'] == "") {
    $pdf->Image('images/noImageAvailable.png',61,211,40,40);
}else{
    $pdf->Image('images/rtoImage/'.$row['image2'],61,211,40,40);
}
if ($row['image3'] == "") {
    $pdf->Image('images/noImageAvailable.png',111,211,40,40);
}else{
    $pdf->Image('images/rtoImage/'.$row['image3'],111,211,40,40);
}
if ($row['image4'] == "") {
    $pdf->Image('images/noImageAvailable.png',161,211,40,40);
}else{
    $pdf->Image('images/rtoImage/'.$row['image4'],161,211,40,40);
}
$pdf->setXY(11,251);
$pdf->SetFont('Arial','',9);
$pdf->Cell(90,6.8,'We hereby certify that we have supplied/installed the ICAT approved RRT as per AIS-090',0,1,'l');
$pdf->Cell(50,6.8,'Date/Time : '.date("d-m-Y/h:i:s", strtotime($row['datetime'])),0,0,'l');
$pdf->Cell(140,6.8,'Place : RANCHI',0,1,'R');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(190,4,'Thank You',0,1,'R');
$pdf->Cell(190,8,'Place : (Authorize Signatory)',0,1,'R');

}else{
}
}else{
    header("Location: /");
}
// $pdf->Output($certificateNo.'.pdf','D');
$pdf->Output();
?>