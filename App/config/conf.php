<?php
define("CONTROLLER_PATH", __DIR__ . "/../controller/");
define("MODEL_PATH", __DIR__ . "/../models/");

require_once("route.php");
require_once CONTROLLER_PATH . 'AbstractController.php';
require_once CONTROLLER_PATH . 'MainController.php';
require MODEL_PATH. 'TaskModel.php';
require MODEL_PATH. 'CustomerModel.php';

require_once __DIR__ . '/../../vendor/autoload.php';



