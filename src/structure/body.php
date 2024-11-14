<?php
class Body
{

    public function landing_page()
    {
?>
        <main>
            <h1>BEST TURF BOOKING PLATFORM IN YOUR AREA</h1>
            <p>
                Unlock Your Perfect play. Book the Best Turf in a Few Clicks.
                Say the Time and Place and your Playtime will be Worth
            </p>

            <div class="search">
                <form action=" " method=" ">

                    <label for="type">Type</label>
                    <select name="type" id="type">
                        <option value="football">Football</option>
                        <option value="cricket">Cricket</option>
                        <option value="basketball">Basketball</option>
                        <option value="volleyball">Volleyball</option>
                    </select>

                    <label for="location">Location</label>
                    <select name="location" id="location">
                        <option value="Langata">Langata</option>
                        <option value="SouthC">South C</option>
                        <option value="Karen">Karen</option>
                        <option value="Kileleshwa">Kileleshwa</option>
                    </select>

                    <label for="date">Date</label>
                    <input type="date" name="date" id="date">

                    <label for="time">Time</label>
                    <input type="time" name="time" id="time">

                    <button type="button" id="search">Search</button>

                </form>
            </div>
            <br>
            <br>
            <div>
                <button type="button" id="btn3">Explore</button>
            </div>
        </main>
        </div>

        <div class="explore">
            <h3>Explore turfs near you</h3>
        </div>

        <div class="register-turf">
            <p>Register your Turf with us</p>
            <button type="button" id="btn4">Register</button>
        </div>
        <br>


    <?php
    }
    public function about_us()
    {
    ?>
        <div class="container">
            <h1>About Playtime</h1>
            <div class="about-content">
                <section class="about-section">
                    <h2>Our Mission</h2>
                    <p>At Playtime, we're passionate about connecting sports enthusiasts with the perfect playing fields. Our mission is to make booking sports facilities as easy as possible, allowing more people to enjoy their favorite games without the hassle of finding and reserving a space.</p>
                </section>

                <section class="about-section">
                    <h2>What We Do</h2>
                    <p>Playtime is a comprehensive platform that bridges the gap between sports facility owners and players. We provide a user-friendly interface for arena owners to list their turfs or other sports facilities, and for players to easily find and book their ideal sport.</p>
                </section>

                <section class="about-section">
                    <h2>Our Vision</h2>
                    <p>We envision a world where every sports enthusiast has easy access to quality playing fields. By streamlining the booking process, we aim to encourage more people to engage in sports, fostering healthier communities and bringing people together through the joy of play.</p>
                </section>

                <section class="about-section">
                    <h2>Join Us</h2>
                    <p>Whether you're a facility owner looking to reach more players or a sports lover searching for the perfect turf, Playtime is here to serve you. Join our growing community and be part of the revolution in sports facility booking!</p>
                </section>
            </div>
        </div>

    <?php
    }
    public function contact_us()
    {
    ?>
        <div class="container">
            <h1>Contact Us</h1>
            <p>Have questions or feedback? We'd love to hear from you!</p>

            <div class="contact-form">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" id="btn4contact">Send Message</button>
                </form>
            </div>
        </div>
    <?php
    }

    public function dashboard($facilityCard)
    {
    ?>
        <main>
            <!-- <h1 id="ownerh1">Welcome back, [OwnerName]!</h1> -->

            <div class="dashboard-content">
                <div class="dashboard-section">
                    <div>
                        <p id="dash-num1">Ksh 250,000</p>

                        <p id="dash-p">Earnings</p>
                    </div>

                    <i class="fas fa-dollar-sign" id="ic1"></i>
                </div>

                <div class="dashboard-section">
                    <div>
                        <p id="dash-num2">895</p>

                        <p id="dash-p">Past Bookings</p>
                    </div>

                    <i class="far fa-calendar-check" id="ic2"></i>
                </div>

                <div class="dashboard-section">
                    <div>
                        <p id="dash-num3"><?= count($facilityCard) ?></p>

                        <a href="facilities.php">
                            <p id="dash-p">Facilities</p>
                        </a>
                    </div>

                    <i class="fa-solid fa-futbol" id="ic3"></i>
                </div>

                <div class="dashboard-section">
                    <div>
                        <p id="dash-num4">14</p>

                        <p id="dash-p">Employees</p>
                    </div>

                    <i class="fas fa-users" id="ic4"></i>
                </div>

            </div>

            <ul class="ul2">
                <div class="btn1">
                    <li><a href=" ">
                            <span> Upcoming Booked Sessions </span>
                            <i class="far fa-arrow-alt-circle-right"></i>
                        </a>
                    </li>
                </div>
            </ul>
        </main>
    <?php
    }
    public function analytics()
    {
    ?>
        <div class="container1">

            <h2>Usage Analytics: Income and Peak Seasons</h2>
            <div class="form-sec">
                <div class="chart-cont">
                    <canvas id="incomeChart"></canvas>
                </div>
                <div class="chart-cont">
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>
        </div>

        <script>
            var incomeData = [5000, 7000, 8000, 10000, 16000, 25000, 19000, 18000, 20000, 24000, 30000, 27000];
            var bookingData = [50, 65, 70, 80, 55, 85, 75, 90, 100, 60, 70, 95];
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];


            var ctx1 = document.getElementById('incomeChart').getContext('2d');
            var incomeChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Income Generated ($)',
                        data: incomeData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Income ($)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });


            var ctx2 = document.getElementById('bookingsChart').getContext('2d');
            var bookingsChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Number of Bookings',
                        data: bookingData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Bookings'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
        </script>
    <?php
    }

    public function searchbar($facilityType)
    {
    ?>
        <form action="<?php print basename($_SERVER['PHP_SELF']); ?>" method="get">
            <div class="container" id="main-content">
                <div style="border: grey solid 1px; border-radius:10px;">
                    <h4 class=" d-flex mt-3 justify-content-center">Search or Pick Marker on Map</h4>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="container">
                            <div class="row justify-content-center align-items-center g-3">
                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <input class="form-control me-2" type="search" placeholder="Keyword" name="keyword" value="<?php print isset($_SESSION['keyword']) ? $_SESSION['keyword'] : ''; ?>">
                                        <button class="btn btn-outline-success px-4 me-2" type="submit" name="searchKeyword" style="width: 100px;">Search</button>
                                        <button type="button" class="btn btn-outline-primary px-4 collapsible-btn me-2" onclick="toggleContent('filters')" style="width: 100px;">
                                            Filters
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary px-4 collapsible-btn" onclick="toggleContent('map2')" style="width: 100px;">
                                            Map
                                        </button>
                                        <script>
                                            function toggleContent(id) {
                                                const content = document.getElementById(id);
                                                content.classList.toggle("show");
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search collapsible-content" id="filters">


                        <label for="type">Type</label>
                        <select name="type" id="type">
                            <option value="0">Select Sport...</option>
                            <?php
                            // print_r($facilityType);
                            foreach ($facilityType as $row) {
                                echo '<option value="' . $row['typeId'] . '" ' . (isset($_SESSION['type']) && $_SESSION['type'] === strval($row['typeId']) ? 'selected' : '') . '>' . $row['type'] . '</option>';
                            }
                            unset($_SESSION['type']);
                            ?>
                        </select>

                        <label for="currency-field">Price per Hour</label>
                        <input type="text" name="currency-field" id="currency-field" pattern="^\KES\d{1,3}(,\d{3})*(\.\d+)?KES" value="<?php print isset($_SESSION['price']) ? $_SESSION['price'] : '';
                                                                                                                                        unset($_SESSION['price']); ?>" data-type="currency" placeholder="KES 1,000.00">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                        <script>
                            // Jquery Dependency

                            $("input[data-type='currency']").on({
                                keyup: function() {
                                    formatCurrency($(this));
                                },
                                blur: function() {
                                    formatCurrency($(this), "blur");
                                }
                            });


                            function formatNumber(n) {
                                // format number 1000000 to 1,234,567
                                return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                            }


                            function formatCurrency(input, blur) {
                                // appends $ to value, validates decimal side
                                // and puts cursor back in right position.

                                // get input value
                                var input_val = input.val();

                                // don't validate empty input
                                if (input_val === "") {
                                    return;
                                }

                                // original length
                                var original_len = input_val.length;

                                // initial caret position 
                                var caret_pos = input.prop("selectionStart");

                                // check for decimal
                                if (input_val.indexOf(".") >= 0) {

                                    // get position of first decimal
                                    // this prevents multiple decimals from
                                    // being entered
                                    var decimal_pos = input_val.indexOf(".");

                                    // split number by decimal point
                                    var left_side = input_val.substring(0, decimal_pos);
                                    var right_side = input_val.substring(decimal_pos);

                                    // add commas to left side of number
                                    left_side = formatNumber(left_side);

                                    // validate right side
                                    right_side = formatNumber(right_side);

                                    // On blur make sure 2 numbers after decimal
                                    if (blur === "blur") {
                                        right_side += "00";
                                    }

                                    // Limit decimal to only 2 digits
                                    right_side = right_side.substring(0, 2);

                                    // join number by .
                                    input_val = "KES " + left_side + "." + right_side;

                                } else {
                                    // no decimal entered
                                    // add commas to number
                                    // remove all non-digits
                                    input_val = formatNumber(input_val);
                                    input_val = "KES " + input_val;

                                    // final formatting
                                    if (blur === "blur") {
                                        input_val += ".00";
                                    }
                                }

                                // send updated string to input
                                input.val(input_val);

                                // put caret back in the right position
                                var updated_len = input_val.length;
                                caret_pos = updated_len - original_len + caret_pos;
                                input[0].setSelectionRange(caret_pos, caret_pos);
                            }
                        </script>

                        <label for="date">Date</label>
                        <input type="date" name="date" id="date">

                        <label for="time">Time</label>
                        <input type="time" name="time" id="time">

                        <button type="submit" id="search" name="searchFilters"><img src="../../assets/icons/search.png" style="width: 20px;" alt=""></button>

                    </div>
                </div>
            <?php
        }
        public function captain($searchResults)
        {
            ?>
                <div class="container-fluid mt-5 mb-5">
                    <?php
                    if (isset($_SESSION['user'])) {
                        if (isset($searchResults)) {
                    ?>
                            <h3>Results for: <?php print isset($_SESSION['keyword']) ? $_SESSION['keyword'] : '';
                                                unset($_SESSION['keyword']); ?></h3>

                    <?php
                        }
                    }
                    ?>

                    <div id="previous" class="d-flex mt-5">

                        <?php
                        if (isset($_SESSION['user'])) {
                            if (isset($searchResults)) {
                                foreach ($searchResults as $card) {
                        ?>
                                    <div class="card" style="width: 18rem">
                                        <img src="../../assets/images/GrassBackground3.jpg" class="card-img-top" alt="">
                                        <?php
                                        if (strval($card['statusId']) === AVAILABLE):
                                        ?>
                                            <div class="available">
                                                Available
                                            </div>
                                        <?php
                                        elseif (strval($card['statusId']) === UNAVAILABLE):
                                        ?>
                                            <div class="unavailable">
                                                Unavailable
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-body">
                                            <h5><?= print $card['name']; ?></h5>
                                            <p class="card-text"><?= $card['description'] ?></p>
                                            <p class="card-text"><?= $card['place_id'] ?></p>
                                            <p class="card-text"><b>KES <?= $card['price_per_hour'] ?></b> per Hour</p>

                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-primary" type="button">Book Now</button>
                                                <button class="btn" type="button" id="favouriteButton" onclick="toggleFavourite();"><img id="favouriteImg" src="../../assets/icons/heart.png" alt="Add to Favourites" style="width: 20px;"></button>
                                                <script>
                                                    function toggleFavourite() {
                                                        const favouriteIcon = document.getElementById("favouriteImg");

                                                        if (favouriteIcon.src.includes("heart.png")) {
                                                            favouriteIcon.src = "../../assets/icons/heart_red.png";
                                                        } else {
                                                            favouriteIcon.src = "../../assets/icons/heart.png";
                                                        }
                                                    }
                                                </script>
                                            </div>

                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="mt-5">
                    <h3>Booking History</h3>
                    <div id="previous" class="d-flex">

                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/images/GrassBackground3.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">SU Sports Complex<br>Pitch A</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go Again</a>
                            </div>
                        </div>

                        <div class="card" style="width: 18rem;">
                            <img src="../../assets/images/GrassBackground3.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">SU Sports Complex<br>Pitch B</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php
        }
        public function calendar($client)
        {
        ?>
            <div class="container" id="main-content">
                <div id="calendar">
                    <?php

                    $service = new Google_Service_Calendar($client);

                    $optParams = [
                        'maxResults' => 10,
                        'orderBy' => 'startTime',
                        'singleEvents' => true,
                        'timeMin' => date('c')
                    ];
                    $results = $service->events->listEvents('primary', $optParams);

                    print_r($results);
                    ?>
                </div>
            </div>

    <?php
        }
    }
