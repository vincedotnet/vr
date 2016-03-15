<?php
namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Product extends AbstractDocument{
    /** @ODM\String */
    protected $name;

    /** @ODM\String */
    protected $label;

    /** @ODM\String */
    protected $team;

    /** @ODM\String */
    protected $art_director;

    /** @ODM\String */
    protected $creative_director;

    /** @ODM\String */
    protected $time_of_design;

    /** @ODM\String */
    protected $type;

    /** @ODM\String */
    protected $property;
    /** @ODM\String */
    protected $description;

    /** @ODM\String */
    protected $show_gif;

    /** @ODM\String */
    protected $gif;

    /** @ODM\Int */
    protected $index;

    /** @ODM\ReferenceMany(targetDocument="\Documents\Photo") */
    protected $photo = array();

    /** @ODM\ReferenceMany(targetDocument="\Documents\Category") */
    protected $category = array();
}