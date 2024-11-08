<?php
class auth
{
    public function signup($conn, $ObjGlobal, $conf)
    {
        if (isset($_POST['signup'])) {
            $signup_err = [];
            $success = [];

            try{

            $fname = $_SESSION['fname'] = $conn->escape_values(ucwords(strtolower($_POST['fname'])));
            $lname = $_SESSION['lname'] = $conn->escape_values(ucwords(strtolower($_POST['lname'])));
            $fullname = implode(' ', [$fname, $lname]);

            // Get form data
            $email = $_SESSION['email'] = $conn->escape_values(strtolower($_POST['email']));
            $username = $_SESSION['username'] = $conn->escape_values(str_replace(' ','',strtolower($_POST['username'])));
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];

            $roleId = null; // Role dropdown

            $agree = $_POST['agree'];

            if (isset($_POST['gender'])) {
                if (count($_POST['gender']) > 1) {
                    $signup_err['one_gender_err'] = 'You can only choose one Gender.';
                }
                foreach ($_POST['gender'] as $gender) {
                    if ($gender === 'Male') {
                        $genderId = 1;
                    } else {
                        $genderId = 2;
                    }
                }
            } else {
                $signup_err['empty_gender_err'] = 'Select your Gender';
            }

            // Server-side validation
            if (ctype_alpha(str_replace(" ", "", str_replace("\'", "", $fullname))) === false) {
                $signup_err['fullname_format_err'] = 'Invalid name format: Full name must contain letters and spaces only.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $signup_err['email_format_err'] = 'Wrong email format';
            } else {
                $domain = substr(strrchr($email, "@"), 1);
                if (!in_array($domain, $conf['valid_mail_domains'])) {
                    $signup_err['email_unauth_domain'] = 'Use allowed domains (gmail.com/strathmore.edu)';
                } else {
                    $email_err = $conn->select_and('tbl_users', ['email' => $email]);
                    if (!empty($email_err)) {
                        $signup_err['email_exists_err'] = 'Email already registered.';
                    }
                }
            }

            $username_err = $conn->select_and('tbl_users', ['username' => $username]);
            if (!empty($username_err)) {
                $signup_err['username_exists_err'] = 'Username already exists. Choose a unique username';
            }

            if (strlen($password) < 8) {
                $signup_err['passw_length_err'] = 'Password must be 8 - 20 characters long';
            }

            if (!preg_match('/[a-z]/', $password)) {
                $signup_err['passw_lwrcse_err'] = 'Password must contain at least one lowercase letter';
            }

            if (!preg_match('/[A-Z]/', $password)) {
                $signup_err['passw_uprcse_err'] = 'Password must contain at least one uppercase letter';
            }

            if (!preg_match('/\d/', $password)) {
                $signup_err['passw_num_err'] = 'Password must contain at least one number';
            }

            if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:\'",.<>?~]/', $password)) {
                $signup_err['passw_symbl_err'] = 'Password must contain at least one special symbol';
            }

            if (preg_match('/\s/', $password)) {
                $signup_err['passw_space_err'] = 'Password must not contain any spaces';
            }

            if ($password !== $confirmpassword) {
                $signup_err['confirm_passw_err'] = 'Passwords do not match';
            }

            if (empty($agree)) {
                $signup_err['agree_err'] = 'You must agree before submitting!';
            }


            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



            if (!count($signup_err)) {
                // Insert the user into the database
                $key = ['fullname', 'email', 'username', 'password', 'genderId'];
                $value = [$fullname, $email, $username, $hashedPassword, $genderId];
                $data = array_combine($key, $value);
                
                if ($conn->insert('tbl_users', $data) === true) {
                    $id = $conn->getLastInsertId();
                    $user_signup = $conn->select_and('tbl_users', ['userid' => $id]);

                    $user = new user($user_signup[0]['userid'], $user_signup[0]['username'], $user_signup[0]['email'], $user_signup[0]['roleId']);
                    $user->setUser();

                    header('Location: role.php');

                    exit();
                }else{
                    //print 'Failed';
                }

                //update logic for other app users i.e. staff,captain
            }
        
             else {

                $ObjGlobal->setMsg('error_msg', 'Error(s) Fill all input fields appropriately', 'invalid');
                $ObjGlobal->setMsg('signup_err', $signup_err, 'invalid');
                $ObjGlobal->setMsg('success', $success, 'valid');
            }
        }catch(Exception $e){
            
            print ("Failed to create user account: " . $e->getMessage());

            }
        
        }
    }




    public function login($conn, $ObjGlobal)
    {

        if (isset($_POST['login'])) {
            $login_err = [];

            $name = $_SESSION['name'] = $conn->escape_values(str_replace(' ', '',strtolower($_POST['name'])));
            $passw = $_POST['passw'];
            if (empty($name)) {
                $login_errors['empty_name_err'] = 'Username or Email required';
            }
            if (empty($passw)) {
                $login_errors['empty_passw_err'] = 'Password cannot be empty';
            }

            $username_err = $conn->select_or('tbl_users', [
                'username' => $name,
                'email' => $name
            ]);

            if (empty($username_err)) {
                $login_err['user_nonexistent_err'] = 'Register User to gain access!';
            }

            if (!count($login_err)) {
                $user_login = $conn->select_or('tbl_users', [
                    'username' => $name,
                    'email' => $name
                ]);

                // var_dump($user_login);

                if ($user_login) {
                    if (password_verify($passw, $user_login[0]['password'])) {
                        $ObjUser = new user($user_login[0]['userid'], $user_login[0]['username'], $user_login[0]['email'], $user_login[0]['roleId']);
                        $ObjUser->setUser();

                        unset($_SESSION['name']);
                        if(strval($user_login[0]['roleId'])=== OWNER){
                            header('Location: owner-dash.php');

                        }elseif(strval($user_login[0]['roleId'])=== STAFF){
                            header('Location: staff.php');

                        }elseif(strval($user_login[0]['roleId'])=== CAPTAIN){
                            header('Location: captain.php');

                        }
                    }
                }
            } else {
                $ObjGlobal->setMsg('login_msg', 'Error(s): Fill input fields appropriately', 'invalid');
                $ObjGlobal->setMsg('login_err', $login_err, 'invalid');
            }
        }
    }

    public function role($conn)
    {
        if (isset($_POST['role'])) {
            $roleId = $conn->escape_values($_POST['flexRadioDefault']);
            echo $roleId;

            $data = ['roleId' => $roleId];

            $result = $conn->update('tbl_users', $data, "userId=" . $_SESSION['user']['u_id']);

            if ($result === true) {
                echo 'result';
                if ($roleId === OWNER) {
                    echo 'OWNER';
                    header('Location: owner-dash.php');
                    exit();
                } elseif ($roleId === CAPTAIN) {
                    echo 'CAPTAIN';
                    header('Location: captain.php');
                    exit();
                }
                $ObjUser = new user($_SESSION['user']['u_id'], $_SESSION['user']['username'], $_SESSION['user']['email'], $roleId);
                $ObjUser->setUser();
                echo 'finished';
            }
        }
    }
}
