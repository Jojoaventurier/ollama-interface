<?php

class HomeController
{
    public function index()
    {
        // Path to the folder where locally installed models are stored
        $modelsDirectory = __DIR__ . '/../models'; // Adjust this path if necessary
        $models = [];

        // Check if the directory exists and read its contents
        if (is_dir($modelsDirectory)) {
            $files = scandir($modelsDirectory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $models[] = $file; // Add each model to the list
                }
            }
        } else {
            addError("The models directory does not exist.");
        }

        // Include the view for the home page
        require __DIR__ . '/../views/home.php';
    }
}