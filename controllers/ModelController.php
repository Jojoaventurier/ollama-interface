<?php

class ModelController {

    const WARNING_SIZE = 10 * 1024 * 1024 * 1024; // 10 GB
    const VERY_LARGE_SIZE = 20 * 1024 * 1024 * 1024; // 20 GB

    public function listModels() {
        $models = $this->fetchLocalModels();
        $remoteModels = $this->fetchRemoteModels();

        require 'views/models/list.php';
    }

    public function download() {
        $modelName = $_GET['name'];
        $size = $_GET['size'];
        $modelSize = $this->getModelSize($modelName, $size);

        // Check for sufficient disk space
        $freeSpace = disk_free_space('/');
        if ($modelSize > $freeSpace) {
            addError('Not enough disk space to download this model.');
        }

        // Alert for large models
        if ($modelSize >= self::VERY_LARGE_SIZE) {
            addError('This model is very large (> 20GB). Please ensure you have sufficient resources.');
        } elseif ($modelSize >= self::WARNING_SIZE) {
            addError('This model is large (> 10GB). Downloading may take time.');
        }

        // Run the download command
        $command = escapeshellcmd("ollama pull $modelName:$size");
        shell_exec($command);

        header('Location: /models');
    }

    private function getModelSize($modelName, $size) {
        // Example API response (size in bytes)
        $response = file_get_contents('https://ollama.com/api/models');
        $models = json_decode($response, true);

        foreach ($models as $model) {
            if ($model['name'] === $modelName && $model['size'] === $size) {
                return $model['diskSize']; // Ensure the API provides size in bytes
            }
        }

        return 0; // Default to 0 if not found
    }

    private function fetchLocalModels() {
        $output = shell_exec('ollama list');
        return explode("\n", trim($output));
    }

    private function fetchRemoteModels() {
        $response = file_get_contents('https://ollama.com/api/models');
        return json_decode($response, true);
    }

}