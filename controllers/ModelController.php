<?php

class ModelController {

    const WARNING_SIZE = 10 * 1024 * 1024 * 1024; // 10 GB
    const VERY_LARGE_SIZE = 20 * 1024 * 1024 * 1024; // 20 GB

    private function fetchLocalModels() {
        $output = shell_exec('ollama list 2>&1');
        if ($output === null) {
            throw new Exception('Failed to execute "ollama list". Ensure the command is installed and accessible.');
        }
        return explode("\n", trim($output));
    }

    private function fetchRemoteModels() {
        $context = stream_context_create([
            'http' => [
                'timeout' => 10, // Timeout in seconds
            ],
        ]);
        $response = @file_get_contents('https://ollama.com/api/models', false, $context);
        if ($response === false) {
            throw new Exception('Failed to fetch remote models.');
        }
        $models = json_decode($response, true);
        if (!is_array($models)) {
            throw new Exception('Invalid API response.');
        }
        return $models;
    }

    public function listModels() {
        try {
            $models = $this->fetchLocalModels();
            $remoteModels = $this->fetchRemoteModels();
            require 'views/models/list.php';
        } catch (Exception $e) {
            error_log('Error in listModels: ' . $e->getMessage());
            $models = [];
            $errors = ['An error occurred. Please try again later.'];
            require 'views/models/list.php';
        }
    }
}