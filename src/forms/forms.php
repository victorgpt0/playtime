<?php
class forms
{
    public function signup_form()
    {
        ?>
        <div class="container-sm mt-5">
            <a href="index.php"><button type="button" class="btn-close" aria-label="Close"></button></a>
            <div class="d-flex justify-content-center">
                <div class="register-container" id="register">
                    <div class="top">
                        <span>Have an account? <a href="login.php">Login</a></span>
                        <header>Sign Up</header>
                    </div>
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="input-field" name="fname" placeholder="Firstname">
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" name="lname" placeholder="Lastname">
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="email" placeholder="Email">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="username" placeholder="Username">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" name="password" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" name="confirmpassword" placeholder="Confirm Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Register">
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" id="register-check">
                            <label for="register-check"> Remember Me</label>
                        </div>
                        <div class="two">
                            <label><a href="#">Terms & conditions</a></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

    }

    public function login()
    {
        ?>

        <div class="container-sm mt-5">
            <a href="index.php"><button type="button" class="btn-close" aria-label="Close"></button></a>
            <div class="d-flex justify-content-center">

                <div class="login-container" id="login">
                    <div class="top">
                        <span>Don't have an account? <a href="signup.php">Sign Up</a></span>
                        <header>Login</header>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Username or Email">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Sign In">
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" id="login-check">
                            <label for="login-check"> Remember Me</label>
                        </div>
                        <div class="two">
                            <label><a href="#">Forgot password?</a></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}