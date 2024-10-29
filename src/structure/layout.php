<?php
class Layout
{
    public function head($title)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title><?php echo $title;?></title>
            <link rel="icon" href="../assets/icons/favicon.svg" type="image/svg+xml">
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
            <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/style.css'>
            
        </head>


        <?php
    }

    public function head_ownerdash($title)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title><?php echo $title;?></title>
            <link rel="icon" href="../assets/icons/favicon.svg" type="image/svg+xml">
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
            <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/owner-dash.css'>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            <link href="../../assets/css/captain.css" rel="stylesheet">
            <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">

        </head>


        <?php
    }

    public function navbar(){
        ?>
        <body>
        <nav class="navbar fixed-top">
            <div class="mainNav">
                <h3>PLAYTIME</h3>
                <br>
                <a href="index.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact Us</a>
                <br>
                <?php
                if(isset($_SESSION['user']['u_id'])){
                    $this->loggedin();
                }else{
                    $this->loggedout();
                }
                ?>
            </div>
        </nav>
        
                    

        <?php

    }

    public function navbar_ownerdash(){
        ?>
        <body>
        <nav>
            <div class="sidebar">
                <h3>PLAYTIME</h3>
                <br>
                <br>
                
                <ul	class="nav">
                    <div class="side-div">
                        <li><a href=" ">
                            <i class="fas fa-server"></i>
                            <span> Dashboard </span>
                        </a>
                        </li>
                    </div>

                    <div class="side-div">
                        <li><a href="facilities.php">
                        <i class="fa-solid fa-futbol"></i>
                            <span> Facilities </span>
                        </a>
                        </li>
                    </div>

                    <div class="side-div">
                    <li><a href=" ">
                        <i class="fas fa-user"></i>
                        <span> Profile </span>
                    </a>
                    </li>
                    </div>


                    <div class="side-div">
                    <li><a href="workers.php">
                        <i class="fas fa-users"></i>
                        <span> Workers </span>
                    </a>
                    </li>
                    </div>

                    <div class="side-div">
                    <li><a href=" ">
                        <i class="fas fa-cogs"></i>
                        <span> Settings </span>
                    </a>
                    </li>
                    </div>

                    <div class="side-div">
                    <li><a href="feedback.php">
                        <i class=" "></i>
                        <span> Feedback </span>
                    </a>
                    </li>
                    </div>

                    <div class="side-div">
                    <li><a href="maintenance.php">
                        <i class=" "></i>
                        <span> Maintenance Request </span>
                    </a>
                    </li>
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>
                    
                    <div class="side-div">
                    <li>
                    <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                        <span> Logout </span>
                    </a>
                    </li>
                    </div>
                    
            
                </ul>
                
            </div>
        </nav>
        
                    

        <?php

    }
    public function navbar_userdash(){
        ?>
        <body>
            
        <nav>
            <div class="sidebar">
                <h3>PLAYTIME</h3>
                <br>
                <br>
                
                <ul	class="nav">
                    <div class="side-div">
                        <li><a href=" ">
                            <i class="fas fa-server"></i>
                            <span> Dashboard </span>
                        </a>
                        </li>
                    </div>

                   

                    <div class="side-div">
                    <li><a href=" ">
                        <i class="fas fa-user"></i>
                        <span> Profile </span>
                    </a>
                    </li>
                    </div>


                    

                    <div class="side-div">
                    <li><a href=" ">
                        <i class="fas fa-cogs"></i>
                        <span> Settings </span>
                    </a>
                    </li>
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>
                    
                    <div class="side-div">
                    <li>
                    <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                        <span> Logout </span>
                    </a>
                    </li>
                    </div>
                    
            
                </ul>
                
            </div>
        </nav>
        
                    

        <?php

    }


    public function loggedout(){
        ?>
        <div>
            <button type="button" id="btn1" onclick="window.location.href='login.php'">Login</button>
            <button type="button" id="btn2" onclick="window.location.href='signup.php'">Register</button>
        </div>

        <?php
    }

    public function loggedin(){
        ?>
        <div>
            <a href="logout.php"><button type="button" id="btn2">Logout</button></a>
        </div>

        <?php

    }

    public function footer()
    {
        ?>
        
        
        <div class="footer">
        <div class="subfooterDiv">
                <h4>PLAYTIME</h4>
                <p>
                    Playtime is a system that enables sports 
                    arena owners to register their business and 
                    allows customers to book sessions in advance.
                </p>
                <p id="copyright">Playtime &copy; 2024</p>
            </div>
            <div class="subfooterDiv">
                <h4>Contact Us</h4>
                <p>Email: playtime@gmail.com</p>
                <p>Phone: +254 234 567 8900</p>
            </div>
            <div class="subfooterDiv">
                <h4>Follow Us</h4>
                <p>Facebook:@playtime_fb </p>
                <p>Twitter: @playtime</p>
                <p>Instagram: @skibidi_playtime</p>
            </div>
        </div>
        <?php
    }
    public function close_js(){
        ?>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>

        <?php
    }
    

        

    
    public function navbar_left(){
        ?>
        <style>
            .navbar-nav{
                height:100vh;
                
            }

            .nav-link img{
                width:50px;
                height:50px;
            }
        </style>
        

        <?php
    }
}