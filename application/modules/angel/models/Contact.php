<?php

class Angel_Model_Contact extends Angel_Model_AbstractModel {
    protected $_document_class = '\Documents\Contact';

    public  function addContact($email1, $email2, $company_address) {
        $data = array("email1"=>$email1, "email2"=>$email2, "company_address"=>$company_address);

        $result = $this->add($data);

        return $result;
    }

    public function saveContact($id, $email1, $email2, $company_address) {
        $data = array("email1"=>$email1, "email2"=>$email2, "company_address"=>$company_address);

        $result = $this->save($id, $data);

        return $result;
    }
} 