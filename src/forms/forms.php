<?php
class forms
{
    public function signup_form($ObjGlobal)
    {
        ?>
        <div class="container-sm mt-5">
            <a href="index.php"><button type="button" class="btn-close" aria-label="Close"></button></a>
            <div class="d-flex justify-content-center">
                <div class="register-container" id="register">
                    <div class="top">
                        <span>Have an account? <a href="login.php">Login</a></span>
                        <header>Sign Up</header>
                        <?php
                        $ObjGlobal->getMsg('error_msg');
                        $err = $ObjGlobal->getMsg('signup_err');
                        $success=$ObjGlobal->getMsg('success');
                        ?>
                    </div>
                    <form action="<?php print basename($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="two-forms">
                            <div class="input-box">
                                <input type="text" class="input-field" name="fname" placeholder="Firstname" <?php print isset($_SESSION['fname']) ? "value='" . $_SESSION['fname'] . "'" : '';
                                unset($_SESSION['fname']); ?>>
                                <i class="bx bx-user"></i>
                            </div>
                            <div class="input-box">
                                <input type="text" class="input-field" name="lname" placeholder="Lastname" <?php print isset($_SESSION['lname']) ? "value='" . $_SESSION['lname'] . "'" : '';
                                unset($_SESSION['lname']); ?>>
                                <i class="bx bx-user"></i>
                            </div>
    </div>
            <?php print isset($err['fullname_format_err']) ? '<div class="invalid">' . $err['fullname_format_err'] . '</div>' : ''; ?>

            <div class="two-forms d-flex justify-content-center">
                <div class="input-box">
                    <input type="checkbox" name="gender[]" id="chbx1" value="Male" <?php
                    print isset($_POST['gender']) ?
                        'checked' : '';
                    unset($_POST['gender']); ?>>
                    <label>Male</label>
                </div>
                <div class="input-box">
                    <input type="checkbox" name="gender[]" id="chbx2" value="Female" <?php
                    print isset($_POST['gender']) ?
                        'checked' : '';
                    unset($_POST['gender']); ?>>
                    <label>Female</label>
                </div>
            </div>
            <?php print isset($err['one_gender_err']) ? '<div class="invalid">' . $err['one_gender_err'] . '</div>' : ''; ?>
            <?php print isset($err['empty_gender_err']) ? '<div class="invalid">' . $err['empty_gender_err'] . '</div>' : ''; ?>
            <div class="input-box mt-3">
                <input type="text" class="input-field" name="email" placeholder="Email" <?php print isset($_SESSION['email']) ? "value='" . $_SESSION['email'] . "'" : '';
                unset($_SESSION['email']); ?>>
                <i class="bx bx-envelope"></i>
            </div>
            <?php print isset($err['email_format_err']) ? '<div class="invalid">' . $err['email_format_err'] . '</div>' : ''; ?>
                <?php print isset($err['email_unauth_domain']) ? '<div class="invalid">' . $err['email_unauth_domain'] . '</div>' : ''; ?>
                <?php print isset($err['email_exists_err']) ? '<div class="invalid">' . $err['email_exists_err'] . '</div>' : ''; ?>
            <div class="input-box">
                <input type="name" class="input-field" name="username" placeholder="Username" <?php print isset($_SESSION['username']) ? "value='" . $_SESSION['username'] . "'" : '';
                unset($_SESSION['username']); ?>>
                <i class="bx bx-user"></i>
            </div>
            <?php print isset($err['username_exists_err']) ? '<div class="invalid">' . $err['username_exists_err'] . '</div>' : ''; ?>
            <div class="input-box">
                <input type="password" class="input-field" name="password" placeholder="Password" <?php print isset($_POST['password']) ? "value='" . $_POST['password'] . "'" : '';
                unset($_POST['fname']); ?>>
                <i class="bx bx-lock-alt"></i>
            </div>
            <?php print isset($err['passw_length_err']) ? '<div class="invalid">' . $err['passw_length_err'] . '</div>' : ''; ?>
            <?php print isset($success['passw_length_err']) ? '<div class="valid">' . $success['passw_length_err'] . '</div>' : ''; ?>
            <?php print isset($err['passw_lwrcse_err']) ? '<div class="invalid">' . $err['passw_lwrcse_err'] . '</div>' : ''; ?>
            <?php print isset($success['passw_lwrcse_err']) ? '<div class="valid">' . $success['passw_lwrcse_err'] . '</div>' : ''; ?>
            <?php print isset($err['passw_uprcse_err']) ? '<div class="invalid">' . $err['passw_uprcse_err'] . '</div>' : ''; ?>
            <?php print isset($success['passw_uprcse_err']) ? '<div class="valid">' . $success['passw_uprcse_err'] . '</div>' : ''; ?>
            <?php print isset($err['passw_num_err']) ? '<div class="invalid">' . $err['passw_num_err'] . '</div>' : ''; ?>
            <?php print isset($success['passw_num_err']) ? '<div class="valid">' . $success['passw_num_err'] . '</div>' : ''; ?>
            <?php print isset($err['passw_symbl_err']) ? '<div class="invalid">' . $err['passw_symbl_err'] . '</div>' : ''; ?>
            <?php print isset($success['passw_symbl_err']) ? '<div class="valid">' . $success['passw_symbl_err'] . '</div>' : ''; ?>
            <?php print isset($err['passw_space_err']) ? '<div class="invalid">' . $err['passw_space_err'] . '</div>' : ''; ?>
            
            <div class="input-box">
                <input type="password" class="input-field" name="confirmpassword" placeholder="Confirm Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <?php print isset($err['confirm_passw_err']) ? '<div class="invalid">' . $err['confirm_passw_err'] . '</div>' : ''; ?>
            <div class="input-box">
                <div class="two">
                    <input type="checkbox" id="register-check" name="agree" value="Agree" <?php
                    print isset($_POST['agree']) ?
                        'checked' : '';
                    unset($_POST['agree']); ?>>
                    <label>I Agree with the <a href="#">Terms & conditions</a></label>
                </div>
            </div>
            <?php print isset($err['agree_err']) ? '<div class="invalid">' . $err['agree_err'] . '</div>' : ''; ?>

            <div class="input-box mt-3">
                <input type="submit" class="submit" name="signup" value="Register">
            </div>
            <br>
                    <div class="d-flex justify-content-center">
                        <p>OR</p>
                    </div>
                    <div class="input-box">
                    <p class="liw d-flex justify-content-center">Sign up with</p>
                <div class="icons d-flex justify-content-center">
                    <a href="<?php ?>" ><ion-icon name="logo-google"></ion-icon></a>
                </div>
                <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
                    </div>
            </form>
        </div>
        </div>
        </div>
        </div>

        <?php

    }

    public function login($ObjGlobal)
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
                    <?php $ObjGlobal->getMsg('login_msg');
                    $err=$ObjGlobal->getMsg('login_err');
                    //var_dump($err);
                    ?>
                    <?php print isset($err['user_nonexistent_err']) ? '<div class="invalid">' . $err['user_nonexistent_err'] . '</div>' : ''; ?>
                    <form action="<?php print basename($_SERVER['PHP_SELF']); ?>" id="postForm" method="post">
                    <div class="input-box">
                        <input type="text" class="input-field" name="name" placeholder="Username or Email" <?php print isset($_SESSION['name']) ? 'value='.$_SESSION['name']: '';
                        unset($_SESSION['name']);?>>
                        <i class="bx bx-user"></i>
                    </div>
                    <?php print isset($err['empty_name_err']) ? '<div class="invalid">' . $err['empty_name_err'] . '</div>' : ''; ?>
                    <div class="input-box">
                        <input type="password" class="input-field" name="passw" placeholder="Password" <?php print isset($_POST['passw']) ? 'value='.$_POST['passw']: '';
                        unset($_POST['passw']);?>>
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <?php print isset($err['empty_passw_err']) ? '<div class="invalid">' . $err['empty_passw_err'] . '</div>' : ''; ?>
                    <div class="input-box">
                        <input type="submit" name="login" class="submit" value="Sign In">
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
                    <br>
                    <div class="d-flex justify-content-center">
                        <p>OR</p>
                    </div>
                    <div class="input-box">
                    <p class="liw d-flex justify-content-center">Log in with</p>
                <div class="icons d-flex justify-content-center">
                    <a href="<?php //print $client->createAuthUrl();?>" ><ion-icon name="logo-google"></ion-icon></a>
                </div>
                <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

}