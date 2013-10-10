<?php
/**
 * Created for deadDrop.
 * User: bill
 * Date: 2013-10-10
 * Time: 2:03 PM
 */

class storedData {
    public function __construct(){
        $this->created = new MongoDate();
    }
    public $created;
    public $key;
    public $data;

}