<?php 
namespace Marmiton\App;

use \PDO;

class MotherShip
{
    private static $db;
    private static $setting;
    private static $_platform;

    public function __construct(){
    }

    static function deployPlatform(){
        spl_autoload_register([__CLASS__, 'autoload']);
        if (is_null(self::$_platform))
            self::$_platform = new MotherShip();
        if ((self::$setting = include "../../setting.php") === false)
            return ("No configuration file for 'Marmiton'!");
        if (is_null(self::$db))
        {
            if (!($dsn = self::getDsn()))
                return ("Missing parameters to connect database. Look for setting.php file and fullfill blanks.");
            try
            {
                self::$db = new PDO($dsn, self::get('db_user'), self::get('db_password'), [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]);
            }
            catch(\PDOException $e)
            {
                return ($e->getMessage());
            }
        }
        return (self::$_platform);
    }

    static function get($key)
    {
        if ($key === "database")
            return (self::$db);
        if ($key && isset(self::$setting[$key]))
            return (self::$setting[$key]);
        return ("This setting do not exist.");
    }

    static function getClass($className)
    {
        $className = ucfirst($className);
        $className = self::$setting['ns_mod'] . $className;
        return (new $className(self::$db)); 
    }

    static function autoload($className)
    {
        if (strpos($className, __NAMESPACE__ . "\\") === 0)
        {
            $className = str_replace(__NAMESPACE__ . "\\", '', $className);
            require $className . '.php';
        }
    }

    private static function getDsn()
    {
        if (!($db_name = self::get('db_name'))
            || !($db_host = self::get('db_host')))
            return (false);
        $dsn = "mysql:dbname={$db_name};host={$db_host}";
        return ($dsn);
    }
}
