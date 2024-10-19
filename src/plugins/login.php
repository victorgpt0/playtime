<?php
require_once 'vendor/autoload.php';
require '../load.php';

$config = json_decode(file_get_contents('api/oauth.json'), true);
//var_dump($config);

$clientID = $config['web']['client_id'];
$clientSecret = $config['web']['client_secret'];
$redirect_uri = 'http://localhost:3000/src/plugins/login.php';

//create client request to google

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirect_uri);
$client->addScope('profile');
$client->addScope('email');




if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    //get user profile
    $goauth = new Google_Service_Oauth2($client);
    $google_info = $goauth->userinfo->get();
    echo '<pre>';
    print_r($google_info);

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
    die('Go back to login page <a href="' . $client->createAuthUrl() . '">Login</a>');
}