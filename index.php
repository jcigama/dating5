<?php
//Require the autoload file
require_once('vendor/autoload.php');

//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/../config.php';

//Class Instances
$f3 = Base::instance();
$validator = new Validate();
$dataLayer = new DataLayer($dbh);
$controller = new Controller($f3);

//Error Reporting
$f3->set('DEBUG', 3);

//Home Page
$f3->route('GET /', function() {
    global $controller;
    $controller->home();
});

//Personal Info Page
$f3->route('GET|POST /personal', function($f3) {
    global $controller;
    $controller->personal();
});

//Profile Page
$f3->route('GET|POST /profileInfo', function($f3) {
    global $controller;
    $controller->profile();
});

//Interests Page
$f3->route('GET|POST /interests', function() {
    global $controller;
    $controller->interests();
});

//Summary Page
$f3->route('GET|POST /summary', function() {
    global $controller;
    $controller->summary();
});

//Admin Page
$f3->route('GET|POST /admin', function() {
    global $controller;
    $controller->admin();
});

//View profile Page
$f3->route('GET /viewProfile', function() {
    global $controller;
    $controller->viewProfile();
});

//Run fat free
$f3->run();