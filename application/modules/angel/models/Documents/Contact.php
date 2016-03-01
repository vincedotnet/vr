<?php
namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Contact extends AbstractDocument {
    /** @ODM\String */
    protected $company_address;

    /** @ODM\String */
    protected $email1;

    /** @ODM\String */
    protected $email2;


} 