<?php
    session_start();
    include 'models.php';
    //Handle all the incoming ajax requests

    $type = $_POST['type'];
    //User login
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
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $user->id;
        echo json_encode(array("success"=>'Έγινε επιτυχής είσοδο.'));
        return;
    }

    //User Logout
    if($type == "logout"){
        unset($_SESSION['user']);
        unset($_SESSION['user_id']);
        echo json_encode(array("msg" => 'Έγινε αποσύνδεση'));
        return;
    }

    //Add listing
    if ($type == "listing"){
        $location = $_POST['location'];
        $price = intval($_POST['price']);
        $availability = $_POST['availability'];
        $squaremeters = intval($_POST['squaremeters']);
        $user = $_SESSION['user_id'];

        $listing = new Listing($location, $price, $availability, $squaremeters, $user);
        $res = $listing->save();
        if(strcmp($res, "ok") == 0) {
            //Returned true so it is saved
            echo json_encode(array("id" => $listing->id, "string" => $listing->get_listing_string()));
            return;
        }
        else{
            //Something went wrong
            echo json_encode(array("error"=>$res));
            return;
        }
    }
    
    //Delete listing
    if($type == "listing_delete"){
        $id = $_POST['id'];
        $listing = new Listing();
        $listing->id = $id;
        $res = $listing->delete();
        if(strcmp($res, "ok") == 0) {
            //Returned true so it is deleted
            echo json_encode(array("msg" => 'Η διαγραφή ήταν επιτυχής'));
            return;
        }
        else{
            //Something went wrong
            echo json_encode(array("error"=>$res));
            return;
        }
    }
?>