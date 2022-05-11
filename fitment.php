<?php
$Version = "V.1.0." . rand(0, 9);
include 'config/conn.php';
session_start();
if (isset($_SESSION['dealerId'])) {
    $dealerIdSession = $_SESSION['dealerId'];
    include 'api/Functions.php';
        $saleBy = UserDemoDetail($conn,$dealerIdSession,"firstName")." ".UserDemoDetail($conn,$dealerIdSession,"lastName").' -SUBDEALER';
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/styles.css?<?php echo $Version; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
    <title>Fitment Report</title>
    <script>
    </script>
</head>

<body>
    <?php include 'assets/pagination/preloader.php'; ?>
    <main>
        <?php include 'assets/pagination/message.php'; ?>
        <div class="header">
            <a href="/">
                <p>SYN AUTO SOLUTIONS PVT. LTD. | MIS PANEL | USER TYPE : SUB-DEALER</p>
            </a>
        </div>

        <div class="section-container">
            <?php include "assets/pagination/sidebar.php"; ?>

            <section class="content">
                <div id="viewBoxClient" class="hide popup-box">
                    <p>Renewal Details</p>
                    <div class="fluid-list">
                        <div class="list-item">
                            <div>Certificate Number</div>
                            <div class="certNo">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Certificate Generated Date</div>
                            <div class="generatedDate">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Certificate AMC Date</div>
                            <div class="nextRenewalDate">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Owner Name</div>
                            <div class="clientName">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Owner Address</div>
                            <div class="clientAddress">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Vehicle No./Chassis No./Engine No.</div>
                            <div class="vehiNoChasiNoEngineNo">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Vehicle Registration Date/Mfg. Year/Model Year</div>
                            <div class="vehiRegisDateMfgYrModelYr">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Front Side/Sides/Real Sides in METRE</div>
                            <div class="WhitYelloRedTape">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Place/State/RTO</div>
                            <div class="placStatRto">N/A</div>
                        </div>
                        <div class="list-item">
                            <div>Fitted By</div>
                            <div class="saleBy">
                                <?php echo $saleBy; ?>
                            </div>
                        </div>
                    </div>
                    <div onclick="info('0')" class="close">CLOSE</div>
                </div>
                <div class="container">
                    <p>FITMENT REPORT</p>
                </div>

                <div class="sld-renewal print-certificate container">
                    <header class="flex-start">
                        <div class="deep-orange">
                            <a href="add_fitment"> ADD FITMENT</a>
                        </div>
                    </header>
                    <div class="sld-renewal body">
                        <table id="renewalsTable" class="display">
                            <thead style="margin-top:20px;">
                                <tr>
                                    <th style="width: 4%;">Sr.No.</th>
                                    <th style="width: 20%;">Issue Date</th>
                                    <th>Certificate Number</th>
                                    <th>Front Side/Sides/Rear Side(in Mtr.)</th>
                                    <th>Vehical Number</th>
                                    <th style="width: 40%;">Sale By</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $CertificateSqlresult = availableCertificate($conn,$dealerIdSession);
                                    if (mysqli_num_rows($CertificateSqlresult) > 0) {
                                        $i = 0;
                                        while ($row=mysqli_fetch_assoc($CertificateSqlresult)) {
                                            $i++ ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo date("d-m-Y", strtotime($row['invoicedate'])); ?>
                                    </td>
                                    <td>
                                        <a target="_blank"
                                            href="certificates?certificateNo=<?php echo $row['certificateno']; ?>"><?php echo $row['certificateno']; ?></a>
                                    </td>
                                    <td>
                                        <?php echo $row['white_tape'].'/'.$row['yellow_tape'].'/'.$row['red_tape']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['vehicalregistrationno']; ?>
                                    </td>
                                    <td>
                                        <?php echo $saleBy; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['status']; ?>
                                    </td>
                                    <td>
                                        <button onclick="info('<?php echo $row['certificateno']; ?>')" class="action">
                                            <i class="material-icons">location_searching</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="action green" onclick="message('Contact Admin.')">
                                            <i class="material-icons">content_cut</i>
                                        </button>
                                    </td>
                                </tr>
                                <?php 
                                       }
                                     }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="js/main.js?<?php echo $Version; ?>"></script>
    <script>
    $(document).ready(function() {
        let token = $("#walletBalance");
        if (parseInt(token.html()) < 4) {
            token.css("color", "red");
        }
        $('#renewalsTable').DataTable({
            responsive: true
        });
        $(".info-btn").click(function() {
            $("#viewBoxClient").toggleClass("hide");
        });
    });
    </script>
</body>

</html>
<?php
} else {
 header("Location: login");
 die();
}
?>