<?php
namespace Marmiton\App\Model;

abstract class Base
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;    
    }

    protected function hydrate($args = null)
    {
        if (!$args)
            return;
        else if (isset($args['db_Obj']))
        {
            $this->db = $args['db_Obj'];
        }
        $self_properties = $this->getObj();
        foreach($self_properties as $key => $val)
        {
            $func = "set" . ucfirst($key);
            if (isset($args[$key]))
                $this->$func($args[$key]);
        }
        $this->db = MotherShip::get('database');
    }

    protected function sendSelectQuery($query, $args = [])
    {
        $db = $this->db;
        $stmt = $db->prepare($query);
        $stmt->setFetchMode($db::FETCH_ASSOC);
        try{
            $stmt->execute($args);
        }
        catch(\PDOException $e)
        {
            return ($e);
        }
        $results = $stmt->fetchAll();
        return ($results);
    }

    protected function sendUIQuery($query, $args = [])
    {
        $db = $this->db;
        $db->quote($query);
        $stmt = $db->prepare($query);
        try{
            $stmt->execute($args);
        }
        catch(\PDOException $e)
        {
            return ($e);
        }
        return ($db->lastInsertId());
    }

    public function getDb()
    {
        return ($this->db);
    }

    abstract function getObj();
}

