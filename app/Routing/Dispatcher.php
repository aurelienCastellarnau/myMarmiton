<?php
namespace Marmiton\App\Routing;
    
class Dispatcher
{
    private $pf;
    private $method;
    private $entity;
    private $args = [];

    public function __construct($pf, $params)
    {
        $this->pf = $pf;
        $this->method = ($params['method']) ? strtolower($params['method']) : 'get';
        $this->entity = ($params['entity']) ? ($params['entity']) : 'recipe';
        $this->args = ($params['data']) ? $params['data'] : null;
    }

    public function root()
    {
        $func = $this->method;
        if ($this->entity === 'recipe')
        {
            require_once 'CrudRecipe.php';
            $exec = new CrudRecipe($this->pf);
            $data = $exec->$func($this->args);
            return $data;
        }
    }
}