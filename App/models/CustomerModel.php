<?php

class CustomerModel
{

    private $database;

    public function __construct(Nette\Database\Connection $database)
    {
        $this->database = $database;
    }

    public function login()
    {
        header('Content-Type: application/json');
        $response = [
            'success' => 0,
            'message' => "Incorrect login or password"
        ];

        $login =  strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);

        $errors = array();
        if ($login == '') {
            $errors[] = "<div>Login cannot be empty!</div>";
        }
        if ($password == '') {
            $errors[] = "<div>Password cannot be empty!</div>";
        }

        if(!empty($errors)) {
            $response['message'] = $errors;
            return json_encode($response);
        }

        $result = $this->database->fetch("SELECT * FROM `customer` WHERE login = '$login'");
        if(empty($result) || $result->password != $password) {
            return $result;
        }

        $_SESSION['auth'] = true;
        $_SESSION['login'] = $result->login;

        $response = [
            'success' => 1,
            "action" => "redirect",
            "redirectUrl" => "/task/taskList/?page=1"
        ];

        return json_encode($response);
    }

    public function logout()
    {
        session_destroy();
        header('Content-Type: application/json');
        return json_encode(['success' => 1,
            "action" => "redirect",
            "redirectUrl" => "/customer/login"]);
    }
}
