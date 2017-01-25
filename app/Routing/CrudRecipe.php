<?php
namespace Marmiton\App\Routing;

use Marmiton\App\Model\Recipe;
use Marmiton\App\Model\Ingredient;
use Marmiton\App\Model\Step;

class CrudRecipe
{
    private $recipe;
    private $ingredient;
    private $step;

    public function __construct($pf)
    {
        $this->recipe = $pf->getClass('recipe');
        $this->ingredient = $pf->getClass('ingredient');
        $this->step = $pf->getClass('step');
    }

    public function get($args = null)
    {
        if ($args['id'])
            $return = $this->recipe->selectOne($args['id']);
        $return = $this->recipe->selectAll());
        if (gettype($return) === 'object')
            return ($return->getMessage());
    }

    public function post($args)
    {
        $id_recipe = $this->recipe->insert($args);
        if (gettype($id_recipe) === 'object')
            return ($id_recipe->getMessage());
        $err = $this->UIForeignKy($args, 'insert');
        if ($err)
            return($err->getMessage());
        return (true);
    }

    public function put($args)
    {
        $err;
        $id_recipe = $this->recipe->update($args);
        if (gettype($id_recipe) === 'object')
            return ($id_recipe->getMessage());
        $err = $this->UIForeignKy($args, 'update');
        if ($err)
            return($err->getMessage());
        return (true);
    }

    public function delete($args)
    {
        $err;
        if (!$args['id'])
            return "Field unindentified.";
        $err = $this->recipe->delete($args);
        if ($err)
            return ($err->getMessage());
        return (true);
    }
    
    private function UIForeignKey($args, $func)
    {
        if (isset($args['ingredients']))
        {
            foreach($args['ingredients'] as $key => $ingredient)
            {
                $ingredient['id_recipe'] = $id_recipe;
                if (!$ingredient['comment'])
                    $ingredient['comment'] = "";
                $err = $this->ingredient->$func($ingredient);
                if (gettype($err) === 'object')
                    return($err);
            }
        }
        if (isset($args['steps']))
        {
            foreach($args['steps'] as $key => $step)
            {
                $step['id_recipe'] = $id_recipe;
                if (!$step['content'])
                    $step['content'] = "";
                $err = $this->step->$func($step);
                if (gettype($err) === 'object')
                    return($err);
            }
        }
        return (false);
    }
}