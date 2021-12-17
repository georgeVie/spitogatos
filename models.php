<?php 
//Include the databse file
include 'database.php';
class User {
    //Database Creds

    //No need for password since we will not add new users
    public $username;
    public $id;

    //User login
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

    function __construct($location = null, $price = null, $availability = null, $squaremeters = null, $user = null, $id = null){
        $this->id = $id;
        $this->location = $location;
        $this->price = $price;
        $this->availability = $availability;
        $this->squaremeters = $squaremeters;
        $this->user = $user;
    }
    //Make the string that will be shown in the view
    function get_listing_string(){
        $string = $this->location.', ';
        $string .= $this->availability.', ';
        $string .= $this->price.' ευρώ, ';
        $string .= $this->squaremeters.' τ.μ.';
        return $string;
    }
    //Save the Listing object in the database
    function save(){
        $res = $this->check_values();
        if(strcmp($res, "ok") !== 0){
            //Values are out of ranges
            return $res;
        }
        $db = new DB();
        $conn = $db->connect();
        if (! $conn){
            return 'Database connection failed';
        }
        $stmt = $conn->prepare("INSERT INTO listings (location, availability, price, squaremeters, user)
            VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param('ssiii', $this->location, $this->availability, $this->price, $this->squaremeters, $this->user);
        
        if ($stmt->execute()){
            $this->id = $stmt->insert_id;
            $conn->close();
            return 'ok';
        }
        else{
            $conn->close();
            return 'Η αποθήκευση δεν ήταν επιτυχής';
        }
    }
    //Delete the listing from the batabase
    function delete(){
        //Check if this listing belongs to logged in user
        $db = new DB();
        $conn = $db->connect();
        if (! $conn){
            return 'Database connection failed';
        }
        $stmt = $conn->prepare("DELETE FROM listings WHERE id = ? AND user = ?");
        $stmt->bind_param('ii', $this->id, $_SESSION['user_id']);
        
        if ($stmt->execute()){
            $conn->close();
            return 'ok';
        }
        else{
            $conn->close();
            return 'Η διαγραφή δεν ήταν επιτυχής';
        }
    }
    //Chek if the listing attributes are within their allowed values
    private function check_values(){
        $location_vals = array('Αθήνα', 'Θεσσαλονίκη', 'Πάτρα', 'Ηράκλειο');
        if (! in_array($this->location, $location_vals)){
            return "Λάθος περιοχή";
        }
        if (! (is_int($this->price) && $this->price >= 50 && $this->price <= 5000000)){
            return "Μη αποδεκτή τιμή";
        }
        $availability_vals = array('ενοικίαση','πώληση');
        if (! in_array($this->availability, $availability_vals)){
            return "Λάθος διαθεσιμότητα";
        }
        if (! (is_int($this->squaremeters) && $this->squaremeters >= 20 && $this->squaremeters <= 1000)){
            return "Μη αποδεκτά τετραγωνικά";
        }
        return "ok";
    }
}

?>