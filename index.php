<?php
session_start();
//This file is used to stich together all the other files and components. It is used as a controller
include 'models.php';

//If user is logged in get the user listings
$listings = array();
if(isset($_SESSION['user']) && $_SESSION['user_id']){
    $id = $_SESSION['user_id'];
    $db = new DB();
    $conn = $db->connect();
    if (! $conn){
        die('Database connection failed');
    }
    $stmt = $conn->prepare("SELECT * FROM listings WHERE user = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();

    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $listing = new Listing($row["location"], $row["price"], $row["availability"], $row["squaremeters"], $id, $row["id"]);
            $listings[] = $listing;
        }
    }
}

include 'view.php';

?>