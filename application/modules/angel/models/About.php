<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/30
 * Time: 15:53
 */

class Angel_Model_About extends Angel_Model_AbstractModel {
    protected $_document_class = '\Documents\About';

    public  function addAbout($photo) {
        $data = array("photo"=>$photo);

        $result = $this->add($data);

        return $result;
    }

    public function saveAbout($id,$photo) {
        $data = array("photo"=>$photo);

        $result = $this->save($id, $data);

        return $result;
    }

    public function getLastByCount($count) {
        $query = $this->_dm->createQueryBuilder($this->_document_class)->sort('created_at', -1)->limit($count)->skip(0);

        $result = $query->getQuery();

        return $result;
    }
} 