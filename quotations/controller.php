<?php

session_start ();
// File name controller.php
// Acts as the go between the view and the model.
include "DatabaseAdapter.php";
if(isset($_GET['getAllquotes'])){
    $theDBA = new DatabaseAdaptor();
    echo json_encode($theDBA->getAllQuotes());
} else if(isset($_GET["selected"])){
    $name = $_GET["selected"];
    $theDBA = new DatabaseAdaptor();
    echo json_encode($theDBA->getAllRoles($name));
} else if(isset($_GET["Add"])){
    $id = $_GET["Add"];
    $theDBA = new DatabaseAdaptor();
    echo json_encode($theDBA->getRatesAdd($id));
}else if(isset($_GET["Minus"])){
    $id = $_GET["Minus"];
    $theDBA = new DatabaseAdaptor();
    echo json_encode($theDBA->getRatesMinus($id));
}else if(isset($_GET["flag"])){
    $id = $_GET["flag"];
    $theDBA = new DatabaseAdaptor();
    echo json_encode($theDBA->getFlag($id));
}else if(isset($_GET["UnflagAll"])){
    $theDBA = new DatabaseAdaptor();
    echo json_encode($theDBA->UnflagAll($id));
}

// TODO 3: Consider this code to control a login.  Then load index.php on localhost.
//  Function for setting up new account.
// Let one user login: (Rick, 1234) or go back to login.php and show
// one error message Avoid undefined indexes with isset.
if (isset ( $_POST ['Username'] ) && isset ( $_POST ['setPW'] )) {
    unset ( $_SESSION ['registerError'] );
    // See if we can log in. 
    // need database access in Quotations Service
    $is_Set = false;
    $theDBA = new DatabaseAdaptor();
    $array = $theDBA->getAllUsers();
    $username = $_POST ['Username'];
    $password = $_POST ['setPW'];
    for($i = 0; $i < count($array); $i++){
        if($array[$i]['username'] === $username) $is_Set = true;
    }
    if (!$is_Set) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $theDBA->setUser($username, $hash);
        header ( 'Location: quotes.php' );
    }
    // TODO 8: Set an error message and go back to to the login page to show error
    else {
        $_SESSION ['registerError'] = 'Account name already exists';
        header ( 'Location: register.php' );
    }
}

//Function for logining into the account
if (isset ( $_POST ['ID'] ) && isset ( $_POST ['ID_PW'] )) {
    unset ( $_SESSION ['loginError'] );
    // See if we can log in.
    // need database access in Quotations Service
    $is_IN = false;
    $theDBA = new DatabaseAdaptor();
    $array = $theDBA->getAllUsers();
    $username = $_POST ['ID'];
    $password = $_POST ['ID_PW'];
    for($i = 0; $i < count($array); $i++){
        if($array[$i]['username'] === $username && password_verify($password, $array[$i]['hash'])){
            $is_IN = true;
            $_SESSION ['login'] = $username;
            header ( 'Location: quotes.php' );
        }
    }
    if (!$is_IN) {
        $_SESSION ['loginError'] = 'Incorrect username or password';
        header ( 'Location: login.php' );
    }
}

if (isset ( $_POST ['UnflagAll'] ) && $_POST ['UnflagAll'] === 'Unflag All') {
    // See if we can log in.
    // need database access in Quotations Service
    $theDBA = new DatabaseAdaptor();
    $theDBA->UnflagAll();
    header ( 'Location: quotes.php' );
}

if (isset ( $_POST ['insertQuote'] ) && $_POST ['insertQuote'] === 'Add Quote') {
    // See if we can log in.
    // need database access in Quotations Service
    $quote = $_POST ['newquote'];
    $author = $_POST ['quoteAuthor'];
    $theDBA = new DatabaseAdaptor();
    $theDBA->addNewQuotes($quote, $author);
    header ( 'Location: quotes.php' );
}


// TODO x11: Unset everything upon logout. Avoid undefined indexes with isset
if (isset ( $_POST ['Logout'] ) && $_POST ['Logout'] === 'Logout') {
    session_destroy ();
    header ( 'Location: quotes.php' );
}

?>