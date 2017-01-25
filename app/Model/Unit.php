<?php

namespace Marmiton\App\Model;

class Unit extends Base
{
    private $id;
    
    private $content;

    /**
    ** Implement from Base class
    */
    public function getObj()
    {
        return get_object_vars($this);
    }

    public function __construct($db)
    {
        parent::__construct($db);
    }

    /**
    ** Getters
    **/
    public function getId()
    {
        return ($this->id);
    }
     
    public function getContent()
    {
        return ($this->content);
    }
    /**
    ** Setters
    **/

    public function setContent($content)
    {
        $this->content = $content;
    }
}