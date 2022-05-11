<?php
$Version = "V.1.0." . rand(0, 9);
include 'config/conn.php';
session_start();
if (isset($_SESSION['dealerId'])) {
    $dealerIdSession = $_SESSION['dealerId'];
    include 'api/Functions.php';
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
    <title>Fitment</title>
    <script type="text/javascript">
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
                <div class="container">
                    <p>ADD FITMENT</p>
                </div>

                <div class="sld-renewal print-certificate container">
                    <header class="flex-start">
                        <div style="background-color:orangered !important;">
                            <a href="fitment">FITMENT REPORT</a>
                        </div>
                    </header>
                    <div class="body">
                        <form action="#" id="AddUserData" enctype="multipart/form-data">
                            <div class="form-element">
                                <div class="form-control">
                                    <label for="customerName">Owner Name</label>
                                    <input type="text" name="customerName" id="customerName" placeholder="Owner Name"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="address">Owner Address</label>
                                    <textarea type="text" name="address" id="address" placeholder="Owner Address"
                                        required></textarea>
                                </div>

                                <div class="form-control">
                                    <label for="contactNumber">Owner Mobile</label>
                                    <input type="text" name="contactNumber" id="contactNumber"
                                        placeholder="Owner Mobile Number" required>
                                </div>
                                <div class="form-control">
                                    <label for="makeModel">Vehicle Make</label>
                                    <input type="text" name="make" id="make" placeholder="Vehicle Make" required>
                                </div>
                                <div class="form-control">
                                    <label for="makeModel">Vehicle Model</label>
                                    <input type="text" name="model" id="model" placeholder="Vehicle Model" required>
                                </div>
                                <div class="form-control">
                                    <label for="registrationNo">Vehicle Number</label>
                                    <input type="text" name="registrationNo" id="registrationNo"
                                        placeholder="Vehical Registration Number" required>
                                </div>
                                <div class="form-control">
                                    <label for="chasisNo">Chassis Number</label>
                                    <input type="text" name="chasisNo" id="chasisNo" placeholder="Chassis Number"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="engineNo">Engine Number</label>
                                    <input type="text" name="engineNo" id="engineNo" placeholder="Engine Number"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="vehicalregisdate">Vehicle Registration Date</label>
                                    <input type="date" name="vehicalregisdate" id="vehicalregisdate"
                                        placeholder="Rotor Seal Number" required>
                                </div>
                                <div class="form-control">
                                    <label for="manufacturingYear">Vehical Manufacturing Year</label>
                                    <input type="text" name="manufacturingYear" id="manufacturingYear"
                                        placeholder="Vehical Manufacturing Year" required>
                                </div>
                                <div class="form-control">
                                    <label for="vecicalmodelno">Vehicle Model Year</label>
                                    <input type="text" name="vecicalmodelYr" id="vecicalmodelno"
                                        placeholder="Vehicle Model Year" required>
                                </div>
                                <div class="form-control">
                                    <label for="placeFitment">Place</label>
                                    <input type="text" name="placeFitment" id="placeFitment" placeholder="Place Fitment"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="white_tape">Front Side(White Tape) in Metre</label>
                                    <p>Available Quantity(in Metre.) :
                                        <?php echo tokensSum($conn,$dealerIdSession,"whiteTape"); ?></p>
                                    <input type="text" class="tapes" name="white_tape" id="white_tape"
                                        placeholder="White RRT in Metre"
                                        maxlength="<?php echo tokensSum($conn,$dealerIdSession,"whiteTape"); ?>"
                                        autocomplete="off" required>
                                </div>
                                <div class="form-control">
                                    <label for="yellow_tape">Sides(Yellow Tape) in Metre</label>
                                    <p>Available Quantity(in Metre.) :
                                        <?php echo tokensSum($conn,$dealerIdSession,"yellowTape"); ?></p>
                                    <input type="text" class="tapes" name="yellow_tape" id="yellow_tape"
                                        placeholder="Yellow RRT in Metre"
                                        maxlength="<?php echo tokensSum($conn,$dealerIdSession,"yellowTape"); ?>"
                                        autocomplete="off" required>
                                </div>
                                <div class="form-control">
                                    <label for="red_tape">Rear Side(Red Tape) in Metre</label>
                                    <p>Available Quantity(in Metre.) :
                                        <?php echo tokensSum($conn,$dealerIdSession,"redTape"); ?></p>
                                    <input type="text" class="tapes" name="red_tape" id="red_tape"
                                        maxlength="<?php echo tokensSum($conn,$dealerIdSession,"redTape"); ?>"
                                        placeholder="Red RRT in Metre" autocomplete="off" required>
                                </div>
                                <div class="form-control">
                                    <label for="invoiceNo">Invoice Number</label>
                                    <input type="text" name="invoiceNo" id="invoiceNo" maxlength="5"
                                        placeholder="Invoice Number" required>
                                </div>
                                <div class="form-control">
                                    <label for="invoiceDate">Invoice Date</label>
                                    <input type="date" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="image1">Installation Image A</label>
                                    <input type="file" name="image1" id="image1"
                                        accept="image/gif, image/jpeg, image/png">
                                </div>
                                <div class="form-control">
                                    <label for="image2">Installation Image B</label>
                                    <input type="file" name="image2" id="image2"
                                        accept="image/gif, image/jpeg, image/png">
                                </div>
                                <div class="form-control">
                                    <label for="image3">Installation Image C</label>
                                    <input type="file" name="image3" id="image3"
                                        accept="image/gif, image/jpeg, image/png">
                                </div>
                                <div class="form-control">
                                    <label for="image4">Installation Image D</label>
                                    <input type="file" name="image4" id="image4"
                                        accept="image/gif, image/jpeg, image/png">
                                </div>
                                <div class="form-control">
                                    <label for="state">Select State</label>
                                    <select name="state" id="state" required>
                                        <option value="">Select State</option>
                                        <option value="jharkhand">JHARKHAND</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label for="selectRTO">Select RTO</label>
                                    <select class="selectRTO" name="selectRTO" required>
                                        <option value="">Select</option>
                                        <option value="JH-01">JH-01</option>
                                        <option value="JH-02">JH-02</option>
                                        <option value="JH-03">JH-03</option>
                                        <option value="JH-04">JH-04</option>
                                        <option value="JH-05">JH-05</option>
                                        <option value="JH-06">JH-06</option>
                                        <option value="JH-07">JH-07</option>
                                        <option value="JH-08">JH-08</option>
                                        <option value="JH-09">JH-09</option>
                                        <option value="JH-10">JH-10</option>
                                        <option value="JH-11">JH-11</option>
                                        <option value="JH-12">JH-12</option>
                                        <option value="JH-13">JH-13</option>
                                        <option value="JH-14">JH-14</option>
                                        <option value="JH-15">JH-15</option>
                                        <option value="JH-16">JH-16</option>
                                        <option value="JH-17">JH-17</option>
                                        <option value="JH-18">JH-18</option>
                                        <option value="JH-19">JH-19</option>
                                        <option value="JH-20">JH-20</option>
                                        <option value="JH-21">JH-21</option>
                                        <option value="JH-22">JH-22</option>
                                        <option value="JH-23">JH-23</option>
                                        <option value="JH-24">JH-24</option>
                                    </select>
                                </div>
                            </div>
                            <button id="UserAddBtn" type="submit">
                                Print Certificate
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="js/main.js?<?php echo $Version; ?>"></script>
    <script>
    $(document).ready(function() {
        let form = $("#AddUserData");
        form.on('submit', function(e) {
            e.preventDefault();
            let UserData = new FormData(this);
            UserDataRegister(UserData);
        });
        $(".tapes").on('keypress', function() {
            setTimeout(() => {
                console.log(parseInt(this.maxLength));
                if (parseInt(this.value) > parseInt(this.maxLength)) {
                    this.value = parseInt(this.maxLength);
                } else if (parseInt(this.maxLength) == 0) {
                    this.value = 0;
                } else {
                    this.value = parseInt(this.value);
                }
            }, 500);
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