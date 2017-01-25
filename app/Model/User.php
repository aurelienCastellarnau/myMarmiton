<?php
namespace Marmiton\App\Model;

class User extends Base
{
    private $id;
    
    private $name;
    
    private $surname;
    
    private $email;
    
    private $password;

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
    
    public function getName()
    {
        return ($this->name);
    }
    
    public function getSurname()
    {
        return ($this->surname);
    }
    
    public function getEmail()
    {
        return ($this->email);
    }
    
    public function getPassword()
    {
        return ($this->password);
    }
    
    /**
    ** Setters
    **/
    public function setName($name)
    {
        $this->name = $name;
    }
