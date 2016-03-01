<?php

class Angel_Model_Category extends Angel_Model_AbstractModel {
    protected $_document_class = '\Documents\Category';

    public  function addCategory($name) {
        $data = array("name"=>$name);

        $result = $this->add($data);

        return $result;
    }

    public function saveCategory($id, $name) {
        $data = array("name"=>$name);

        $result = $this->save($id, $data);

        return $result;
    }
}
