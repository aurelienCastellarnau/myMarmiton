<?php
namespace Marmiton\App\Model;

class Step extends Base
{
    private $id;

    private $idRecipe;

    private $content;

    private $number;

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

    public function getIdRecipe()
    {
        return ($this->idRecipe);
    }

    public function getContent()
    {
        return ($this->content);
    }

    public function getNumber()
    {
        return ($this->number);
    }

    /**
    ** Setters
    **/
    public function setIdRecipe($idRecipe)
    {
        $this->idRecipe = $idRecipe;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function selectAllFromRecipe($idRecipe)
    {
        $db = $this->getDb();
        $args = [$idRecipe];
        $query = "Select * from step Where idRecipe = ?";
        return ($this->sendSelectQuery($query, $args));
    }

    public function insert($args)
    {
        $db = $this->getDb();
        $query = "Inert Into step (id_recipe, content, number) values (:id_recipe, :content, :number)";
        return ($this->sendUIQuery($query, [
            ':id_recipe' => $args['id_recipe'],
            ':content' => $args['content'],
            ':number' => $args['number']
        ]));
    }
    
    public function update($args)
    {
        $db = $this->getDb();
        $query = "Update step set id_recipe = :id_recipe, content = :content, number = :number where id = :id";
        return ($this->sendUIQuery($query, [
            ':id' => $args['id'],
            ':content' => $args['content'],
            ':number' => $args['number'],
            ':id_recipe' => $args['id_recipe']
        ]));        
    }

}
