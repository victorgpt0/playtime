<?php
require '../load.php';


if (isset($_GET['code'])) {
    if($google_oauth->handleCallback($_GET['code'])){
        
    //get user profile
    $goauth = new Google_Service_Oauth2($google_oauth->getClient());
    $google_info = $goauth->userinfo->get();
    //echo '<pre>';
    //print_r($google_info);

    $email = $google_info['email'];
    $email_exists = $conn->select_and('tbl_users', [
        'email' => $email
    ]);
    if (!empty($email_exists)) {
        $ObjUser = new user($email_exists[0]['userid'], $email_exists[0]['username'], $email_exists[0]['email'], $email_exists[0]['roleId']);
        $ObjUser->setUser();

        header('Location: ../index.php');
    } else {
        $fullname = ucwords(strtolower($google_info['name']));

        $username = $ObjGlobal->generateUsername();

        $username_exists = $conn->select_and('tbl_users', [
            'username' => $username
        ]);
        while (!empty($username_exists)) {
            $username_exists = $conn->select_and('tbl_users', [
                'username' => $username
            ]);
            $username = $ObjGlobal->generateUsername();
        }
        $key = ['fullname', 'email', 'username'];
        $value = [$fullname, $email, $username];
        $data = array_combine($key, $value);
        $insert = $conn->insert('tbl_users', $data);
        if ($insert === true) {
            $id = $conn->getLastInsertId();
            $goauth = $conn->select_and('tbl_users', ['userid' => $id]);

            $user = new user($goauth[0]['userid'], $goauth[0]['username'], $goauth[0]['email'], $goauth[0]['roleId']);
            $user->setUser();

            header('Location: ../index.php');
        }

    }


} else {
    die('Go back to login page <a href="' . $google_oauth->createAuthUrl() . '">Login</a>');
}
}