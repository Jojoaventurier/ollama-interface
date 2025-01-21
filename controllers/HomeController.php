<?php

class HomeController
{
    public function index()
    {


        // Include the view for the home page
        require __DIR__ . '/../views/home.php';
    }
}