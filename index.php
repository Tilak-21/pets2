<?php
session_start();

//This is my CONTROLLER!


// Error Reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// Require the Autoload File
require_once ('vendor/autoload.php');

//instantiate the F3 Base Class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
//    echo '<h1>Dinner is served!</h1>';

    $view = new Template();
    echo $view->render('views/home.html');

});

//Order route
$f3->route('GET|POST /order', function($f3) {

if($_SERVER['REQUEST_METHOD'] == 'POST') {


    if(empty($POST['pet'])) {
        echo "Please specify a Pet Type!";
    }
//    creating variables and using post
    $petname = $_POST['pet'];
    $petcolor = $_POST['color'];




//    adding to session array.
    $f3-> set('SESSION.petname', $petname);
    $f3-> set('SESSION.petcolor', $petcolor);

//    Redirection after successful submission.
    $f3->reroute("summary");

}
//    else {
//        echo "GET Method!";
//    }


    $view = new Template();
    echo $view->render('views/pet-order.html');

});

$f3->route('GET /summary', function() {
//    echo '<h1>Dinner is served!</h1>';

    $view = new Template();
    echo $view->render('views/order-summary.html');

});

//Run Fat-Free - invoking a method!
$f3->run();
