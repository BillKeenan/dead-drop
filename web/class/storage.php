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

        $db->tracks->insert(Array("key"=>$data->key,"created"=>new MongoDate()));
        return $data->key;
    }

    public function checkTimedKey($id){
        $db = $this->Mongo();
        $date = new DateTime();
        $date->sub(new DateInterval('PT30M'));
        $expiry = new MongoDate($date->getTimestamp());
        //load it up
        $data = $db->formKeys->findOne(array("key"=>$id,"created"=>array('$gt'=>$expiry)));

        if ($data){
            $db->formKeys->remove(array("key"=>$id));
            $db->formKeys->remove(array("created"=>array('$lt'=>$expiry)));
            return true;
        }else{
            return false;
        }
    }

    public static function timedKey(){
        $id = uniqid();
        $db = Storage::Mongo();
        //load it up
        $db->formKeys->insert(Array("key"=>$id,"created"=>new MongoDate()));
        return $id;
    }


    private static function Mongo(){
        $mongo = new MongoClient();
        $db = $mongo->deadDrop;
        return $db;
    }

    public function GetData($id)
    {
        $db = $this->Mongo();
        $date = new DateTime();
        $yesterday = new MongoDate($date->sub(new DateInterval('P1D'))->getTimestamp());

        $data = $db->drops->findOne(array("key"=>$id,"created"=>array('$gt'=>$yesterday)));

        if ($data){
            $db->drops->remove(array("_id"=>$data["_id"]));
            $db->drops->remove(array("created"=>array('$lt'=>$yesterday)));
            $db->tracks->update(Array("key"=>$data["key"]),Array('$set'=>array("pickup"=>new MongoDate())));

        }
        return $data["data"];
    }
}