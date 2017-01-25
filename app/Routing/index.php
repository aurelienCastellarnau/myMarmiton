<?php
namespace Marmiton;

use Marmiton\App\MotherShip;
use Marmiton\App\Routing\Dispatcher;

require dirname(__DIR__) . '\\MotherShip.php';
$pf = MotherShip::deployPlatform();
require $pf->get('__VEN__') . "autoload.php";

$params['method'] = $_SERVER['REQUEST_METHOD'];
$params['entity'] = ($_GET['uri']) ? $_GET['uri'] : null;
$params['data'] = json_decode(file_get_contents('php://input'), true);
$dispatch = new Dispatcher($pf, $params);
$data = $dispatch->root();
$jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
echo $jsonData;
