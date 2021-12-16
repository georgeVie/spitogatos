<?php 
//Include the databse file
include 'database.php';

class User {
    //Database Credsa

    //No need for password since we will not add new users
    public $username;
    public $id;
    /*
    function __construct($username, $id) {
        $this->username = $username;
        $this->id = $id;
    }*/

    function login($username, $password){
        $db = new DB();
        $conn = $db->connect();
        if (! $conn){
            return 'Database connection failed';
        }
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();

        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0){
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $this->username = $username;
                $this->id = $row["id"];
                return true;
            }
        }
        else{
            return false;
        }
    }

}

class Listing {

    public $id;
    public $location;
    public $price;
    public $availability;
    public $squaremeters;
    public $user;

    function __construct($id, $location, $price, $availability, $squaremeters, $user){
        $this->id = $id;
        $this->location = $location;
        $this->price = $price;
        $this->availability = $availability;
        $this->squaremeters = $squaremeters;
        $this->user = $user;
    }
    
    function get_listing_string(){
        $string = $this->location.', ';
        $string .= $this->availability.', ';
        $string .= $this->price.' ευρώ, ';
        $string .= $this->availability.' τ.μ.';
        return $string;
    }
}

?>