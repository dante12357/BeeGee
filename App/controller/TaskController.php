<?php


class TaskController extends AbstractController
{
    private $task;

    public function __construct()
    {
        parent::__construct();
        $this->task = new TaskModel($this->database);
    }

    public function taskListAction()
    {
        $this->render('index');
    }

    public function taskListTableAction()
    {

        $result = $this->task ->getAll();

        $this->render('table', $result);

    }

    public function addTaskAction()
    {
        $result = $this->task ->addTask();
        echo $result;
    }

    public function updateTaskAction()
    {
        $this->task ->updateTask();
        header('Content-Type: application/json');
        echo json_encode(["success" => "1",
            "action" => "redirect",
            "redirectUrl" => "task/taskList/?page=1"]);
    }

    public function editAction()
    {
        $getOne = $this->task ->getOne();
        $this->render('edit', $getOne);

    }
}
