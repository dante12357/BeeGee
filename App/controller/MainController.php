<?php

class MainController extends AbstractController
{
    public function __construct()
    {
    }

    public function indexAction()
    {
        $this->render('index');
    }
}
