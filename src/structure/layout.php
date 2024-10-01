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
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/style.css'>
        </head>

        <body>

        <?php
    }

    public function navbar(){
        ?>
        <div class="background-img">
        <nav>
            <div class="mainNav">
                <h3>PLAYTIME</h3>
                <br>
                <a href=" ">Home</a>
                <a href=" ">About Us</a>
                <a href=" ">Contact Us</a>
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
                    <button type="button" id="btn1" onclick="window.location.href='../drafts/index3.html'">Login</button>
                    <button type="button" id="btn2" onclick="window.location.href='../drafts/index3.html'">Register</button>
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
        <footer>
        <div class="footerDiv">
            <div class="subfooterDiv">
                <h4>PLAYTIME</h4>
                <p>
                    Playtime is a system that enables a sports 
                    arena owner to register their business and 
                    enable their customers to book sessions in advance.
                </p>
                <p id="copyright">Playtime &copy; 2024</p>
            </div>
            <div class="subfooterDiv">
                <h4>Contact Us</h4>

            </div>
            <div class="subfooterDiv">
                <h4>Follow Us</h4>
            </div>
        </div>
        
    </footer>

        </body>
        </html>

        <?php

    }
}