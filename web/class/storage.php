<?php
/**
 * Created for deadDrop.
 * User: bill
 * Date: 2013-10-09
 * Time: 10:35 AM
 */

class Storage {


//ok data looks ok, lets save it
    public function StoreData(&$data){
        $id = uniqid(null,true);
        $data->key = $id;
        $db = $this->Mongo();
        $db->drops->insert($data);

        return $id;
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
}