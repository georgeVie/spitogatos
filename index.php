<?php
//This file is used to stich together all the other files and components
include 'models.php';

//If user is logged in get the user listings
if(isset($_COOKIE['user']) && $_COOKIE['user_id']){
    $id = $_COOKIE['user_id'];
    $db = new DB();
    $conn = $db->connect();
    if (! $conn){
        return 'Database connection failed';
    }
    $stmt = $conn->prepare("SELECT * FROM listings WHERE user = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();

    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0){
        $listings = array();
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $listing = new Listing($row["id"], $row["location"], $row["price"], $row["availability"], $row["squaremeters"], $id);
            $listings[] = $listing;
        }
    }
}

include 'view.php';

?>