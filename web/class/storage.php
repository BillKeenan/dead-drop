<?php
/**
 * Created for deadDrop.
 * User: bill
 * Date: 2013-10-09
 * Time: 10:35 AM
 */
include_once('./Model/storedData.php');
class Storage {


//ok data looks ok, lets save it
    public function StoreData($crypt){

        $data = new storedData();
        $data->key = uniqid(null,true);
        $data->data=$crypt;

        $db = $this->Mongo();
        $db->drops->insert($data);

        return $data->key;
    }

    public function TimedKey($key){
        $db = $this->Mongo();
        //load it up

    }

    private function Mongo(){
        $mongo = new MongoClient();
        $db = $mongo->deadDrop;
        return $db;
    }

    public function GetData($id)
    {
        $db = $this->Mongo();
        $data = $db->drops->findOne(array("key"=>$id));
        return $data["data"];
    }
}