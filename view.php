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
            if(!isset($_SESSION['user'])){
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
                            <p class="h3">Σύστημα διαχείρισης αγγελιών (καλώς ήλθες <?php echo $_SESSION['user'] ?>)</p>
                        </div>
                    </div>
                    <!-- Main content row -->
                    <div class="row mt-3">
                        <!-- Form col -->
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
                                    <input type="hidden" id="type" name="type" value="listing">
                                    <button type="submit" class="btn btn-primary">Καταχώρηση Αγγελίας</button>
                                </form>
                            </div>
                        </div>
                        <!-- Listings col -->
                        <div class="col-md-6 offset-md-1" id="listings_col">
                            <div class="row">
                                <div class="col-auto">
                                    <p class="h4">Λίστα αγγελιών</p>
                                </div>
                            </div>
                            <?php 
                                if(count($listings) > 0) {
                                    foreach ($listings as $listing){
                                        ?> 
                                            <div class="row" data-listing-id="<?php echo $listing->id; ?>">
                                                <div class="col-auto" class="listing_text">
                                                    <span class="listing_text"><?php echo $listing->get_listing_string(); ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="text-danger listing_delete" data-listing-id="<?php echo $listing->id; ?>">Διαγραφή</a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                                else {
                                    ?> 
                                        <div class="row">
                                            <div class="col-auto">
                                                <p class="">Δεν έχετε καταχωρημένη αγγελία στην βάση.</p>
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
        <!-- Listing row to be copied for addind rows -->
        <div class="row" id="listing_template" style="display: none;">
            <div class="col-auto">
                <span class="listing_text"></span>
            </div>
            <div class="col-auto">
                <a href="#" class="text-danger listing_delete" data-listing-id="">Διαγραφή</a>
            </div>
        </div>
        <!-- Srcripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="main.js" type="text/javascript"></script>
    </body>
</html>