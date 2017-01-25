<?php

namespace Marmiton\App\Model;

class Ingredient extends Base
{
    private $id;
    private $id_recette;
    /**
    ** property name string
    ** recipe's name
    */
    private $name;

    /**
    ** property kind string
    ** kind of ingredient (vegeteble, meat etc...)
    */
    private $kind;

    /**
    ** property quantity int
    ** quantity mesured in $unit
    */
    private $quantity;

    /**
    ** property unit string
    ** extract from Unit class
    */
    private $unit;

    /**
    ** property comment string
    ** allow user to add any comment on the ingredient.
    */
    private $comment;

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
    * Getters
    */
    public function getId()
    {
        return ($this->id);
    }

    public function getName()
    {
        return($this->name);
    }

    public function getKind()
    {
        return($this->kind);
    }

    public function getQuantity()
    {
        return($this->quantity);
    }

    public function getUnit()
    {
        return($this->unit);
    }

    public function getComment()
    {
        return($this->comment);
    }

    /**
    * Setters
    */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setKind($kind)
    {
        $this->kind = $kind;
    }

    public function setQuantity($qt)
    {
        $this->quantity = $qt;
    }

    public function setUnit($u)
    {
        $this->unit = $u;
    }

    public function setComment($c)
    {
        $this->comment = $c;
    }

    public function insert($args){
        $db = $this->getDb();
        $query = "Insert Into ingredient (id_recipe, name, kind, quantity, unit, comment) values (:id_recipe, :name, :kind, :quantity, :unit, :comment)";
        return ($this->sendUIQuery($query, [
            ':id_recipe' => $args['id_recipe'],
            ':name' => $db->quote($args['name']),
            ':kind' => $db->quote($args['kind']),
            ':quantity' => $args['quantity'],
            ':unit' => $db->quote($args['unit']),
            ':comment' => $db->quote($args['comment'])
        ]));
    }

    public function update($args)
    {
        $db = $this->getDb();
        $query = "Update ingredient set id_recipe = :id_recipe, name = :name, kind = :kind, quantity = :quantity, unit = :unit, comment = :comment) where id = :id";
        return ($this->sendUIQuery($query, [
            ':id' => $args['id'],
            ':id_recipe' => $args['id_recipe'],
            ':name' => $args['name'],
            ':kind' => $args['kind'],
            ':quantity' => $args['quantity'],
            ':unit' => $args['unit'],
            ':comment' => $args['comment']
        ]));        
    }
}