<?php
class auth
{
    public function signup($conn, $ObjGlobal, $conf)
    {
        if (isset($_POST['signup'])) {

            $signup_err = [];
            $success=[];

            $fname = $_SESSION['fname'] = $conn->escape_values(ucwords(strtolower($_POST['fname'])));
            $lname = $_SESSION['lname'] = $conn->escape_values(ucwords(strtolower($_POST['lname'])));
            $fullname = implode(' ', [$fname, $lname]);

            // Get form data
            $email =$_SESSION['email']= $conn->escape_values(strtolower($_POST['email']));
            $username =$_SESSION['username']=$conn->escape_values(strtolower($_POST['username'])); 
            $password = $_POST['password'];
            $confirmpassword=$_POST['confirmpassword'];

            $roleId = 2; // Role dropdown

            $agree=$_POST['agree'];

            if(isset($_POST['gender'])){
                if(count($_POST['gender'])>1){
                    $signup_err['one_gender_err']='You can only choose one Gender.';
                }
                foreach($_POST['gender'] as $gender){
                    if($gender==='Male'){
                        $genderId=1;
                    }else{
                        $genderId=2;
                    }
                }
            }else{
                $signup_err['empty_gender_err']='Select your Gender';
            }

            //server-side validation
            //fullname
            if (ctype_alpha(str_replace(" ", "", str_replace("\'", "", $fullname))) === false) {
                $signup_err['fullname_format_err'] = 'Invalid name format: Full name must contain letters and spaces only.';
            }

            //email
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

            //username
            // Check if the username already exists
            $username_err = $conn->select_and('tbl_users', ['username' => $username]);

            if (!empty($username_err)) {
                $signup_err['username_exists_err'] = 'Username already exists. Choose a unique username';
            }

            //password

            //length
            if (strlen($password) < 8) {
                $signup_err['passw_length_err'] = 'Password must be 8 - 20 characters long';
            } else {
                $success['passw_length_err'] = 'Password is 8 - 20 characters long!';
            }

            //lowercase
            if (!preg_match('/[a-z]/', $password)) {
                $signup_err['passw_lwrcse_err'] = 'Password must contain atleast one lowercase letter';
            } else {
                $success['passw_lwrcse_err'] = 'Password has atleast one lowercase letter!';
            }

            //uppercase
            if (!preg_match('/[A-Z]/', $password)) {
                $signup_err['passw_uprcse_err'] = 'Password must contain atleast one uppercase letter';
            } else {
                $success['passw_uprcse_err'] = 'Password has atleast one uppercase letter!';
            }

            //numbers
            if (!preg_match('/\d/', $password)) {
                $signup_err['passw_num_err'] = 'Password must contain atleast one number';
            } else {
                $success['passw_num_err'] = 'Password has atleast one number!';
            }

            //symbols
            if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:\'",.<>?~]/', $password)) {
                $signup_err['passw_symbl_err'] = 'Password must contain atleast one special symbol';
            } else {
                $success['passw_symbl_err'] = 'Password has atleast one special symbol!';
            }

            //spaces
            if (preg_match('/\s/', $password)) {
                $signup_err['passw_space_err'] = 'Password must not contain any spaces';
            }

            //confirm password
            if ($password !== $confirmpassword) {
                $signup_err['confirm_passw_err'] = 'Passwords do not match';
            }

            //agree
            if (empty($agree)) {
                $signup_err['agree_err'] = 'You must agree before submitting!';
            }

            
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            
            if(!count($signup_err)){
                // Insert the user into the database
<<<<<<< HEAD
                $key=['fullname','email', 'username', 'password', 'genderId', 'roleId'];
                $value=[$fullname,$email,$username,$hashedPassword,$genderId,$roleId];
                $data=array_combine($key,$value);
                $insert=$conn->insert('tbl_users',$data);
                if($insert === TRUE){
=======
                $key = ['fullname', 'email', 'username', 'password', 'genderId', 'roleId'];
                $value = [$fullname, $email, $username, $hashedPassword, $genderId, $roleId];
                $data = array_combine($key, $value);
                $insert = $conn->insert('tbl_users', $data);
                if ($insert === TRUE) {
                    $id=$conn->getLastInsertId();
                    $user_signup=$conn->select_and('tbl_users',['userid'=>$id]);

                    $user= new user($user_signup[0]['userid'],$user_signup[0]['username'], $user_signup[0]['email'], $user_signup[0]['roleId']);
                    $user->setUser();
                    
>>>>>>> d00e45efdd51d71907c786979b9348fbbde9b352
                    header('Location: owner.php');

                }
                //update logic for other app users i.e. staff,captain
            }else{
                $ObjGlobal->setMsg('error_msg','Error(s) Fill all input fields appropriately','invalid');
                $ObjGlobal->setMsg('signup_err',$signup_err,'invalid');
                $ObjGlobal->setMsg('success',$success,'valid');
            }



        }


    }
    public function login($conn,$ObjGlobal){

        if(isset($_POST['login'])){
            $login_err=[];

            $name=$_SESSION['name']=$conn->escape_values(strtolower($_POST['name']));
            $passw=$_POST['passw'];
            if(empty($name)){
                $login_errors['empty_name_err']='Username or Email required';
            }
            if(empty($passw)){
                $login_errors['empty_passw_err']='Password cannot be empty';
            }
            // Check if the username already exists
            $username_err = $conn->select_or('tbl_users', [
                'username' => $name,
                'email'=> $name
            ]);

            if (empty($username_err)) {
                $login_err['user_nonexistent_err']='User is not Registered!';
            }

            if(!count($login_err)){
                $user_login=$conn->select_or('tbl_users',[
                    'username'=>$name,
                    'email'=>$name
                ]);
    
                // var_dump($user_login);
    
                if($user_login){
                    if(password_verify($passw,$user_login[0]['password'])){
                        $ObjUser = new user($user_login[0]['userid'], $user_login[0]['username'],  $user_login[0]['email'], $user_login[0]['roleId']);
                        $ObjUser->setUser();
    
                        unset($_SESSION['name']);
                        header('Location: owner.php');
                        //die(var_dump($_SESSION['user']));
                    }
                }
    
            }else{
                $ObjGlobal->setMsg('login_msg','Error(s): Fill input fields appropriately','invalid');
                $ObjGlobal->setMsg('login_err',$login_err,'invalid');
            }
        }
    }

}