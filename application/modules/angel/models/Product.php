<?php

class Angel_Model_Product extends Angel_Model_AbstractModel {
    protected $_document_class = '\Documents\Product';

    public  function addProduct($name, $label, $team, $art_director, $creative_director, $time_of_design, $type, $property, $description, $photo, $category, $show_gif, $gif, $index) {
        $data = array("name"=>$name, "label"=> $label, "team"=>$team, "art_director"=>$art_director, "creative_director"=>$creative_director, "time_of_design"=>$time_of_design, "type"=>$type, "property"=>$property, "description"=>$description, "photo" => $photo, "category"=>$category, "show_gif"=>$show_gif, "gif"=>$gif, "index"=>$index);

        $result = $this->add($data);

        return $result;
    }

    public function saveProduct($id, $name, $label, $team, $art_director, $creative_director, $time_of_design, $type, $property, $description, $photo, $category, $show_gif, $gif, $index) {
        $data = array("name"=>$name, "label"=> $label, "team"=>$team, "art_director"=>$art_director, "creative_director"=>$creative_director, "time_of_design"=>$time_of_design, "type"=>$type, "property"=>$property, "description"=>$description, "photo" => $photo, "category"=>$category, "show_gif"=>$show_gif, "gif"=>$gif, "index"=>$index);

        $result = $this->save($id, $data);

        return $result;
    }

    public function getNotCategory() {
        $result = false;

        $query = $this->_dm->createQueryBuilder($this->_document_class)->sort('index', -1);

        $result = $query->getQuery();

        return $result;
    }

    public function getByCategory($category_id) {
        $result = false;

        if ($category_id) {
            $query = $this->_dm->createQueryBuilder($this->_document_class)->field('category.$id')->equals(new MongoId($category_id))->sort('index', -1);

            $result = $query->getQuery();
        }

        return $result;
    }

    public function getInCategoryId($category_id) {
        $result = false;

        if ($category_id) {
            $query = $this->_dm->createQueryBuilder($this->_document_class)->field('category.$id')->equals(new MongoId($category_id))->sort('index', -1);

            $result = $query->getQuery();
        }

        return $result;
    }

    public function getProductByCategory($category_id) {
        $result = false;

        if ($category_id) {
            $query = $this->_dm->createQueryBuilder($this->_document_class)->field('category.$id')->equals(new MongoId($category_id))->sort('created_at', -1);

            $result = $query->getQuery()->getSingleResult();
        }

        if ($result)
            return true;
        else
            return false;
    }
}
