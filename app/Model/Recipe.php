<?php
namespace Marmiton\App\Model;

class Recipe extends Base
{
    private $id;

    /**
    ** property name string
    ** recipe's name
    */
    private $name;

    /**
    ** property kind string
    ** kind of recipe (entry, main dish or dessert)
    */
    private $kind;

    /**
    ** property difficulty int
    */
    private $difficulty;

    /**
    ** property stars int
    ** user's like
    */
    private $stars;

    /**
    ** property prepTime int
    ** Time require to prepare the recipe in min
    */
    private $prepTime;

    /**
    ** property cookTime intthis->
    ** the time in min you should not overpass if you want to eat.
    */
    private $cookTime;

    /**
    ** property ingredients array of Ingredient
    ** recipe's ingredients.
    ** Pk Recipe = Fk Ingredient
    */
    private $ingredients;

    /**
    ** property steps array of Step
    ** recipe's steps
    ** Pk Recipe = Fk Steps
    */
    private $steps;

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
        return ($this->name);
    }

    public function getKind()
    {
        return ($this->kind);
    }

    public function getDifficulty()
    {
        return ($this->difficulty);
    }

    public function getStars()
    {
        return ($this->stars);
    }

    public function getPrepTime()
    {
        return ($this->prepTime);
    }

    public function getCookTime()
    {
        return ($this->cookTime);
    }

    public function getIngredients()
    {
        return ($this->ingredients);
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

    public function setDifficulty($dif)
    {
        $this->difficulty = $dif;
    }

    public function setStars($stars)
    {
        $this->stars = $stars;
    }

    public function setPrepTime($pt)
    {
        $this->prepTime = $pt;
    }

    public function setCookTime($ct)
    {
        $this->cookTime = $ct;
    }

    public function setIngredients($i)
    {
        if (is_array($i) && $this->ingredients){
            $tmp = array_merge($this->ingredients, $i);
            $this->ingredients = $tmp;
        }
        else if (is_array($i) && !$this->ingredients)
            $this->ingredients = $i;
        else
            $this->ingredients[] = $i;
    }

    public function selectAll()
    {
        $db = $this->getDb();
        $query = "Select * from recipe";
        return ($this->sendSelectQuery($query));
    }

    public function selectOne($id)
    {
        $db = $this->getDb();
        $query = "Select * from recipe where id = :1";
        return ($this->sendSelectQuery($query, [
            ':1' => $id
        ]));
    }
    
    public function insert($args)
    {
        $db = $this->getDb();
        $query = "Insert Into recipe (name, kind, difficulty, stars, prepTime, cookTime) Values (:name, :kind, :difficulty, :stars, :prepTime, :cookTime)";
        return ($this->sendUIQuery($query, [
            ':name' => $args['name'],
            ':kind' => $args['kind'],
            ':difficulty' => $args['difficulty'],
            ':stars' => $args['stars'],
            ':prepTime' => $args['prepTime'],
            ':cookTime' => $args['cookTime']
        ]));        
    }
    
    public function update($args)
    {
        $db = $this->getDb();
        $query = "Update recipe set name = :name, kind = :kind, difficulty = :difficulty, stars = :stars, prepTime = :prepTime, cookTime = :cookTime where id = :id";
        return ($this->sendUIQuery($query, [
            ':id' => $args['id'],
            ':name' => $args['name'],
            ':kind' => $args['kind'],
            ':difficulty' => $args['difficulty'],
            ':stars' => $args['stars'],
            ':prepTime' => $args['prepTime'],
            ':cookTime' => $args['cookTime']
        ]));        
    }
}