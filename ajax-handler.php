<?php
    include 'models.php';
    //Handle all the incoming ajax requests

    $type = $_POST['type'];
    if ($type == "login"){
        $user = new User();
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (!$user->login($username, $password)){
            //User failed to login
            echo json_encode(array("error"=>'Λάθος κωδικός ή και όνομα χρήστη'));
            return;
        }
        //Login was successful
        $cookie_name = "user";
        $cookie_value = $username;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $cookie_name = "user_id";
        $cookie_value = $user->id;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        echo json_encode(array("success"=>'Έγινε επιτυχής είσοδο.'));
        return;
    }
?>