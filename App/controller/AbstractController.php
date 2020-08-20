<?php

class AbstractController
{
    protected $database;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=myDB";
        $user = "root";
        $password = "root";
        $this->database = new Nette\Database\Connection($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    public function render($view, $data = null)
    {
        $part = Routing::getPathParts();
       // extract($data);
        require(__DIR__ . "/../views/$part[1]/$view.php");
    }
}
