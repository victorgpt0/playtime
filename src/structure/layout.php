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
            <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/style.css'>
            
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
                if(isset($_SESSION['id'])){
                    $this->loggedin();
                }else{
                    $this->loggedout();
                }
                ?>
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
                    <button type="button" id="btn2">Logout</button>
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
        
    </body>
        </html>

        <?php

    }
}