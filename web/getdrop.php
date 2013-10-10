<?php
/**
 * Created for deadDrop.
 * User: bill
 * Date: 2013-10-09
 * Time: 10:11 AM
 */

include_once("./class/storage.php");

//validate request


//TODO: should put something in to make sure that the page was generated within the last 5 minutes or somethign
//TODO: lets get a time generated key in the form post that we can check against

//must be post
if (! strtoupper($_SERVER['REQUEST_METHOD'])=="GET"){
    header('HTTP/1.1 500 Internal Server Error');
    print("invalid method");
    exit;
}

//only 1 form value
if (! (count(array_keys($_GET)) ==1)){
    header('HTTP/1.1 500 Internal Server Error');
    print("invalid number of values");
    exit;
}

if (! array_key_exists("id",$_GET)){
    header('HTTP/1.1 500 Internal Server Error');
    print("data missing");
    exit;
}

//ok, looks alright
$id = $_GET["id"];
//ok should have a .
if (strpos($id,".") <0){
    header('HTTP/1.1 500 Internal Server Error');
    print("bad data");
    exit;
}

//upper bound
if (strlen($id)>30){
    header('HTTP/1.1 500 Internal Server Error');
    print("bad data");
    exit;
}

//data should look as expected, and parse as data

$storage = new Storage();
$json = $storage->GetData($id);

header('Content-Type: application/json');
print json_encode($json);
