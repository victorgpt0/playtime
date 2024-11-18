<?php

use Google\Service\CloudSearch\Card;

class captain
{
    public function search($conn)
    {
        $connn = $conn->getConnection();
        if (isset($_GET['searchKeyword']) || isset($_GET['searchFilters'])) {
            $keyword2 = $_SESSION['keyword'] = isset($_GET['keyword']) ? $conn->escape_values($_GET['keyword']) : '';
            $keyword = isset($_GET['keyword']) ? '%' . $conn->escape_values($_GET['keyword']) . '%' : '%';
            $type = $_SESSION['type'] = isset($_GET['type']) ? $conn->escape_values($_GET['type']) : '';
            $price2 = $_SESSION['price'] = isset($_GET['currency-field']) ? $conn->escape_values($_GET['currency-field']) : '';
            $price = isset($_GET['currency-field']) ? $conn->escape_values(preg_replace('/[^0-9.]/', '', $_GET['currency-field'])) : '';
            $date = isset($_GET['date']) ? $conn->escape_values($_GET['date']) : '';
            $time = isset($_GET['time']) ? $conn->escape_values($_GET['time']) : '';
            //print $keyword.' '.$type.''.$price.' '.$date.' '.$time;

            $sql = "SELECT * FROM tbl_facilities WHERE name LIKE ?";

            $params = [$keyword];

            if ($type) {
                $sql .= " AND typeId = ?";
                $params[] = $type;
            }
            if ($price) {
                $sql .= " AND price_per_hour = ?";
                $params[] = $price;
            }
            // if ($date) {
            //     $sql .= " AND availability_date = ?";
            //     $params[] = $date;
            // }
            // if ($time) {
            //     $sql .= " AND availability_time = ?";
            //     $params[] = $time;
            // }

            //echo $sql;
            //print_r($params);
            $stmt = $connn->prepare($sql);
            $stmt->execute($params);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //print_r($results);
        }
    }
    public function book($conn,$ObjGlobal)
    {
        if (isset($_GET['f'])) {
            //print '<div class="container" id="main-content">';
            $f_id = $_SESSION['f_id'] = $conn->escape_values($_GET['f']);
            try {
                $book = $conn->select_join('tbl_facilities', [
                    [
                        'type' => 'left',
                        'table' => 'tbl_status',
                        'on' => 'tbl_facilities.statusId=tbl_status.statusId'
                    ],
                    [
                        'type' => 'left',
                        'table' => 'tbl_f_types',
                        'on' => 'tbl_facilities.typeId=tbl_f_types.typeId'
                    ]
                ], [
                    'facilityId' => $f_id
                ]);
                // print_r($book);
?>

                <div class="container" id="app" style="width:50%;">

                <?php 
                    $err=$ObjGlobal->getMsg('b_err');
                    ?>
                    <form action="<?php print basename($_SERVER['PHP_SELF']).'?f='.$f_id?>" method="post">
                        <h1 class="d-flex justify-content-center mb-5 mt-4">Book Facility</h1>

                        

                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <b>Facility</b>
                            <div style="max-width: 60%; text-align:right;"><?= $book[0]['name'] ?></div>
                        </div>

                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <b>Description</b>
                            <div style="max-width: 60%; text-align:right;"><?= $book[0]['description'] ?></div>
                        </div>

                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <b>Location</b>
                            <div style="max-width: 60%; text-align:right;"><?= $book[0]['place_id'] ?></div>
                        </div>

                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <b>Max Capacity</b><?= $book[0]['max_capacity'] ?>
                        </div>

                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <b>Price per Hour</b><?= $book[0]['price_per_hour'] ?>
                        </div>

                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <b>Contact</b><?= $book[0]['contact'] ?>
                        </div>


                        <input type="hidden" name="facilityId" value="<?=$f_id?>">
                        <b>Pick A Date</b>
                        <div class="d-flex justify-content-center mb-2 pb-2 border-bottom mt-3">
                            <div id="datepicker"></div>
                            <input type="hidden" id="chosen_date" name="date" value="<?php print isset($_SESSION['dateBooked'])? $_SESSION['dateBooked'] : ''; unset($_SESSION['dateBooked']);?>">
                        </div>

                        <b>Time</b>
                        <div class="d-flex justify-content-between mb-2 pb-4 border-bottom mt-3" style="gap: 20px;">
                            <input id="timepicker" type="text" name="startTime" class="form-control" placeholder="Start Time" required value="<?php print isset($_SESSION['startTime'])? $_SESSION['startTime'] : ''; unset($_SESSION['startTime']);?>">
                            <input id="timepicker2" type="text" name="endTime" class="form-control" placeholder="End Time" required value="<?php print isset($_SESSION['endTime'])? $_SESSION['endTime'] : ''; unset($_SESSION['endTime']);?>">
                        </div>

                        <b>I wish to borrow equipment</b> <i>(Leave unchecked if 'No')</i>
                        <div class="d-flex justify-content-center mt-3 mb-2 pb-2 border-bottom">
                            <div style="width: 90%;">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" name="chxbx" type="checkbox" value="0" aria-label="Checkbox for following text input" <?php echo isset($_SESSION['chxbx'])? 'checked' : ''; unset($_SESSION['chxbx']);?>>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Text input with checkbox"
                                        name="borrow" placeholder="Specify..." value="<?php print isset($_SESSION['borrow'])? $_SESSION['borrow'] : ''; unset($_SESSION['borrow']);?>">
                                </div>
                            </div>
                        </div>
                        <b>To Pay:</b>
                        <div class="border-bottom mb-2 pb-2">
                            <div class="d-flex justify-content-between mt-2">
                                <b>
                                    <h5 id="price"></h5>
                                    <input type="hidden" name="price" id="priceidjs" value="<?php print isset($_SESSION['totalPrice'])? $_SESSION['totalPrice'] : ''; unset($_SESSION['totalPrice']);?>">
                                </b>
                                <div class="d-flex" style="gap: 30px;">
                                    <button class="btn btn-primary collapsible-btn" type="button" onclick="togglePay()">Pay Now</button>
                                    <button class="btn btn-secondary" type="button">Pay Later</button>
                                </div>
                            </div>
                            <div id="pay_now" class="collapsible-content">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 5%;">
                                    <img src="../../assets/images/mpesa.png" style="width:150px;" alt="">
                                    <div class="mt-3 mb-3">
                                        <input id="phone" style="height: 30px; border-radius:10px;" type="tel">
                                    </div>
                                    <button class="btn btn-success" type="button" style="height: 35px;" onclick="pay()">Pay</button>
                                </div>
                            </div>
                        </div>

                        <script>
                            const input = document.querySelector("#phone");
                            window.intlTelInput(input, {
                                loadUtilsOnInit: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@24.7.0/build/js/utils.js"),
                                initialCountry: "auto",
                                geoIpLookup: callback => {
                                    fetch("https://ipapi.co/json")
                                        .then(res => res.json())
                                        .then(data => callback(data.country_code))
                                        .catch(() => callback("us"));
                                }
                            });

                            function togglePay() {
                                content = document.getElementById("pay_now");
                                content.classList.toggle("show");
                            }
                        </script>

                        <b>QR Code</b><i> (You are required to present this code to be granted access to the facility.)</i>
                        <br>
                        <p>QR Code will be provided in the e-receipt after booking.<br>You can also access it on the dashboard. </p>
                        <div class="d-flex justify-content-center mb-2 pb-2 border-bottom">
                            <img src="../../assets/images/qrcode.png" style="width: 150px;" alt="">
                        </div>

                        <div class="d-flex justify-content-center mb-2 pb-2 border-bottom">
                            <button type="submit" name="book" class="btn btn-success" style="width: 50%;">B O O K</button>
                        </div>

                    </form>

                    <?php if(isset($err['success'])):?>
                    <div class="alert alert-success mt-5 mb-5" role="alert" >
                            <h5><?php print isset($err['success'])? $err['success']: '' ;?></h5>
                    </div>
                    <?php endif ?>

                    <div class="d-flex justify-content-between mb-2 pb-2 mt-5">
                        <button type="button" class="btn btn-secondary-outline">
                            <<<b>Back to Dashboard</b>
                        </button>
                        <button type="button" class="btn btn-info">
                            <b>Download e-receipt</b>
                        </button>
                    </div>
                    

                </div>
                


                <script>
                    $('#datepicker').datepicker({
                        format: "yyyy/mm/dd",
                        todayBtn: "linked",
                        clearBtn: true,
                        multidate: false,
                        todayHighlight: true,
                        toggleActive: true,
                        startDate: new Date()
                    });
                    $('#datepicker').on('changeDate', function() {
                        $('#chosen_date').val(
                            $('#datepicker').datepicker('getFormattedDate')
                        );
                    });
                    $('#timepicker').timepicker({
                        timeFormat: 'h:mm p',
                        interval: 30,
                        minTime: '<?= $book[0]['open_time'] ?>',
                        maxTime: '<?= $book[0]['close_time'] ?>',
                        // defaultTime: '11',
                        //startTime: '10:00',
                        dynamic: true,
                        dropdown: true,
                        scrollbar: true,
                        change: check
                    });
                    $('#timepicker2').timepicker({
                        timeFormat: 'h:mm p',
                        interval: 30,
                        minTime: '<?= $book[0]['open_time'] ?>',
                        maxTime: '<?= $book[0]['close_time'] ?>',
                        // defaultTime: '11',
                        //startTime: '10:00',
                        dynamic: true,
                        dropdown: true,
                        scrollbar: true,
                        change: check
                    });

                    function calculatePrice(startTime, endTime) {
                        const pph = parseFloat(<?= $book[0]['price_per_hour'] ?>);

                        console.log({
                            "startTime": startTime,
                            "endTime": endTime,
                            "pph": pph
                        });
                        const start = convertTo24Hr(startTime);
                        const end = convertTo24Hr(endTime);
                        const [startHour, startMinute] = start.split(':').map(Number);
                        const [endHour, endMinute] = end.split(':').map(Number);
                        const sminutes = startHour * 60 + startMinute;
                        const eminutes = endHour * 60 + endMinute;
                        let totalMinutes = eminutes - sminutes;
                        if (totalMinutes < 0) {
                            totalMinutes += 24 * 60;
                        }
                        const hours = totalMinutes / 60;
                        const totalPrice = pph * hours;
                        console.log({
                            "start": start,
                            "end": end,
                            "startHour": startHour,
                            "startMinute": startMinute,
                            "endHour": endHour,
                            "endMinute": endMinute,
                            "sminutes": sminutes,
                            "eminutes": eminutes,
                            "totalMinutes": totalMinutes,
                            "hours": hours,
                            "totalPrice": totalPrice
                        });
                        document.getElementById("price").innerText = `KES ${totalPrice.toFixed(2)}`;
                        document.getElementById("priceidjs").value=totalPrice.toFixed(2);


                    }

                    function check() {
                        console.log("Check function called");
                        const startTime = $('#timepicker').val();
                        const endTime = $('#timepicker2').val();
                        if (startTime && endTime) {
                            calculatePrice(startTime, endTime);
                        } else {
                            console.log("Wewe");
                        }
                    }

                    function convertTo24Hr(timeStr) {
                        timeStr = timeStr.trim();
                        console.log(timeStr);
                        const [time, period] = timeStr.split(' ');
                        let [hours, minutes] = time.split(':').map(Number);
                        console.log(time);
                        if (period.toUpperCase() === "PM" && hours !== 12) {
                            hours += 12;
                        } else if (period.toUpperCase() === "AM" && hours === 12) {
                            hours = 0;
                        }
                        return `${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}`;

                    }

                    function phoneValidate(phone) {

                        const cleanedNumber = phone.replace(/\D/g, '');

                        // Check if starts with 0 or 254 or +254
                        let normalizedNumber = cleanedNumber;
                        if (cleanedNumber.startsWith('0')) {
                            // Convert 07... to 2547...
                            normalizedNumber = '254' + cleanedNumber.slice(1);
                        } else if (cleanedNumber.startsWith('254')) {
                            normalizedNumber = cleanedNumber;
                        } else if (cleanedNumber.length === 9) {
                            // If just 7XXXXXXXX is provided
                            normalizedNumber = '254' + cleanedNumber;
                        }

                        // Final format should be 12 digits starting with 254
                        const isValid = /^254[17]\d{8}$/.test(normalizedNumber);

                        return {
                            isValid,
                            formattedNumber: isValid ? normalizedNumber : phone,
                            error: isValid ? null : 'Please enter a valid phone number'
                        };
                    }

                    function pay() {
                        const phone = document.getElementById("phone").value;
                        const validate = phoneValidate(phone);
                        console.log(validate);
                        if (validate.isValid) {
                            const formData = new FormData();
                            formData.append('phoneNum', validate.formattedNumber)
                            fetch('<?php print basename($_SERVER['PHP_SELF']); ?>', {
                                    method: 'post',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        console.log('Payment initiated:', data.message);
                                    } else {
                                        console.error('Payment failed:', data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        }

                    }
                </script>

            <?php

            } catch (Exception $e) {
                error_log($e->getMessage(), 3, 'errors/error.log');
            }
            //print '</div>';
        } else {
            ?>
            <div class="alert alert-danger mt-5" role="alert">
                <h2>Oops!</h2>

                <p>Something happened. Please check your connection or
                    contact support for further assistance.</p>
                <a href="#">FAQ</a> | <a href="#">Contact Support</a>
            </div>
<?php
        }
    }

    public function bookFacility($conn,$ObjGlobal)
    {
        ob_start();
        $b_errors = [];
        if (isset($_POST['book'])) {
            $f_id = $conn->escape_values($_POST['facilityId']);
            $fa_id=intval($f_id);
            $u_id=$_SESSION['user']['u_id'];
            $dateBooked =$_SESSION['dateBooked']= $conn->escape_values($_POST['date']);
            $mysqlDate = date('Y-m-d', strtotime(str_replace('/','-',$dateBooked)));
            $startTime =$_SESSION['startTime']= $conn->escape_values($_POST['startTime']);
            $endTime =$_SESSION['endTime']= $conn->escape_values($_POST['endTime']);
            $borrow=null;
            $totalprice=$_SESSION['totalPrice']=$conn->escape_values($_POST['price']);
            $_SESSION['chxbx']=$_POST['chxbx'];
            $paystatus_id=1;
            $status_id=1;
            if (isset($_POST['chxbx'])) {
                $borrow =$_SESSION['borrow']= $conn->escape_values($_POST['borrow']);
            }
            //echo $f_id,$dateBooked,$startTime,$endTime,$borrow,$_POST['chxbx'],$totalprice,$mysqlDate;
//             $allVars = get_defined_vars();

// // Display types and values
// echo '<pre>';
// foreach ($allVars as $varName => $varValue) {
//     echo "Variable Name: $varName\n";
//     var_dump($varValue);
//     echo "\n";
// }

             if(!count($b_errors)){
                
                try{
                    
                    $key=['facilityId','userId','dateBooked','start_time','end_time','totalprice','to_borrow','paystatus_id','statusid'];
                    $value=[$fa_id,$u_id,$mysqlDate,$startTime,$endTime,$totalprice,$borrow,$paystatus_id,$status_id];
                    $data=array_combine($key,$value);
                    //print 'so far';
                    if($conn->insert('tbl_bookings',$data)===true){
                        //print_r($conn->insert('tbl_bookings',$data));
                        $b_errors['success']='Facility has been Successfully booked. Please download your e-receipt';
                        $ObjGlobal->setMsg('b_err',$b_errors,'invalid');
                        error_log("\nInsert success to tbl_booking",3,'errors/error.log');
                    }else{
                        error_log("\nInsert Failure to tbl_booking",3,'errors/error.log');
                    }
                    //die(print_r($data));
                }catch(Exception $e){
                    error_log($e,3,'errors/error.log');
                }
            }
            ob_end_flush();



        }
    }

    public function processPayment($conn)
    {
        if (isset($_POST['phoneNum'])) {
            header('Content-Type: application/json');

            try {
                // Get the phone number from POST
                $phone = $conn->escape_values($_POST['phoneNum']) ?? '';

                // Create your payment object and process payment
                $ObjPay = new stkpush(); // Replace with your actual class name
                $result = $ObjPay->stkPush($phone);

                // Send success response
                echo json_encode([
                    'success' => true,
                    'message' => 'Payment processed successfully',
                    'data' => $result
                ]);
            } catch (Exception $e) {
                // Send error response
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }
    }
}
