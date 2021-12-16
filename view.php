<?php
    session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="main.css" rel="stylesheet">

        <title>Γιώργος Βιέννας - Σύστημα διαχείρισης αγγελιών</title>
    </head>
    <body>
        <div class="container-fluid">
        <?php
            if(!isset($_COOKIE['user'])){
                //user is not logged in
                ?>
                    <div class="row mt-5 justify-content-center">
                        <div class="col-auto">
                            <form id="login_form">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Όνομα Χρήστη</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Κωδικός</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <input type="hidden" id="type" name="type" value="login">
                                <button type="submit" class="btn btn-primary">Είσοδος</button>
                            </form>
                        </div>
                    </div>
                <?php
            }
            else {
                ?>
                    <div class="row p-2 bg-light justify-content-center">
                        <div class="col-auto">
                            <p class="h3">Σύστημα διαχείρισης αγγελιών (καλώς ήλθες <?php echo $_COOKIE['user'] ?>)</p>
                        </div>
                    </div>
                    <!-- Main content row -->
                    <div class="row mt-3">
                        <div class="col-md-3 offset-md-1">
                            <div class="listing-div">
                                <form id="listing_form">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Τιμή:</label>
                                        <input type="text" class="form-control" id="price" name="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Περιοχή:</label>
                                        <select id="location" name="location" class="form-select">
                                            <option value="Αθήνα">Αθήνα</option>
                                            <option value="Θεσσαλονίκη">Θεσσαλονίκη</option>
                                            <option value="Πάτρα">Πάτρα</option>
                                            <option value="Ηράκλειο">Ηράκλειο</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="availability" class="form-label">Διαθεσιμότητα:</label>
                                        <select id="availability" name="availability" class="form-select">
                                            <option value="ενοικίαση">ενοικίαση</option>
                                            <option value="πώληση">πώληση</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="squaremeters" class="form-label">Τετραγωνικά:</label>
                                        <input type="text" class="form-control" id="squaremeters" name="squaremeters">
                                    </div>
                                    <input type="hidden" id="type" name="type" value="login">
                                    <button type="submit" class="btn btn-primary">Καταχώρηση Αγγελίας</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-1">
                            <div class="row">
                                <div class="col-auto">
                                    <p class="h4">Λίστα αγγελιών</p>
                                </div>
                            </div>
                            <?php 
                                foreach ($listings as $listing){
                                    ?> 
                                        <div class="row">
                                            <div class="col-auto">
                                                <?php echo $listing->get_listing_string(); ?>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="text-danger" data-listing-id="<?php echo $listing->id; ?>">Διαγραφή</a>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                <?php
            }
        ?>
        </div>
        <!-- Srcripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="main.js" type="text/javascript"></script>
    </body>
</html>