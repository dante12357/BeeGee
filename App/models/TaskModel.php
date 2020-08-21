<?php

class TaskModel
{

    private $database;
    const NUMBER_LINES = 3;
    const DEFAULT_ORDER = 'id';
    const DEFAULT_SORT = 'ASC';
    const DEFAULT_PAGE = 1;
    const DEFAULT_PERFORMED = '0';

    public function __construct(Nette\Database\Connection $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {

        $order = self::DEFAULT_ORDER;
        if ($_GET['order']) {
            $order = strip_tags($_GET['order']);
        }

        $sort = self::DEFAULT_SORT;
        if ($_GET['sort']) {
            $sort = strip_tags($_GET['sort']);
        }

        $page = self::DEFAULT_PAGE;
        if ($_GET["page"]) {
            $page = strip_tags($_GET["page"]);
        }

        $result = [];
        $numberLines = self::NUMBER_LINES;
        $getAll = $this->database->query("SELECT * FROM `task` ");
        $getAll = $getAll->getRowCount();
        $total_pages = ceil($getAll / $numberLines);

        $start_from = ($page - 1) * $numberLines;

        $result['data'] = $this->database->fetchAll("SELECT * FROM `task` ORDER BY $order $sort LIMIT $start_from, $numberLines");

        $result['total_pages'] = $total_pages;
        return $result;
    }

    public function getOne()
    {
        $id = $_GET['id'];
        $result = $this->database->fetch("SELECT * FROM `task` WHERE id='$id'");

        return $result;
    }

    public function addTask()
    {
        header('Content-Type: application/json');

        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $task = strip_tags($_POST['task']);

        $errors = [];
        if ($name == '') {
            $errors[] = "<div>Name cannot be empty!</div>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "<div>Invalid email!</div>";
        }
        if ($task == '') {
            $errors[] = "<div>Task cannot be empty!</div>";
        }

        if (empty($errors)) {
            $this->database->query("INSERT INTO `task` (`name`, `email`, `task`) VALUES ('$name', '$email', '$task')  ");
            return json_encode(["success" => "1",
                "action" => "add",
                "addUrl" => "task/taskListTable",
                "message" => "<div>Success add task</div>"]);
        }

        return json_encode(['success' => 0,
            'message' => $errors]);
    }

    public function updateTask()
    {
        $id = strip_tags($_POST['id']);
        $performed = self::DEFAULT_PERFORMED;
        if ($_POST['performed']) {
            $performed = '1';
        }
        $task = strip_tags($_POST['task']);
        $was_edit = 1;
        $this->database->query("UPDATE `task` SET `task` = '$task', `performed` = '$performed', `was_edit` = '$was_edit' WHERE `id`='$id'  ");
    }

}
