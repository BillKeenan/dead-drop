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
if (! strtoupper($_SERVER['REQUEST_METHOD'])=="POST"){
    header('HTTP/1.1 500 Internal Server Error');
    print("invalid method");
    exit;
}

//only 1 form value
if (! (count(array_keys($_POST)) ==2)){
    header('HTTP/1.1 500 Internal Server Error');
    print("invalid number of values");
    exit;
}

if (! array_key_exists("data",$_POST) || ! array_key_exists("key",$_POST)){
    header('HTTP/1.1 500 Internal Server Error');
    print("data missing");
    exit;
}


//ok, looks alright
$data = $_POST["data"];
$id = $_POST["key"];

//data should look as expected, and parse as data
$jsonData = json_decode($data);

$keysToCheck = ["iv","v","iter","ks","ts","mode","adata","cipher","salt","ct"];

//verify our various keys
foreach($keysToCheck as $key=>$value){
    if (! property_exists($jsonData,$value)){
        header('HTTP/1.1 500 Internal Server Error');
        print("data missing:".$value);
        exit;
    }
}


$storage = new Storage();

if (!$storage->checkTimedKey($id)){
    header('HTTP/1.1 500 Internal Server Error');
    print("data missing");
    exit;
}

$id = $storage->StoreData($jsonData);

header('Content-Type: application/json');
print json_encode(Array("id"=>$id));
