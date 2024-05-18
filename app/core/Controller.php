<?php

namespace app\core;

use app\core\Application;

class Controller {

    public string $layout = 'main';
    public function render($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    /**
     * Send a JSON response.
     *
     * @param array $data The data to be converted to JSON.
     * @param int $status The HTTP status code.
     * @param int $options JSON encoding options.
     * @return string JSON-encoded string.
     * @throws JsonException If encoding fails.
     */
    protected function jsonResponse(array $data, int $status = 200, int $options = 0): string
    {
        header('Content-Type: application/json');
        http_response_code($status);
        return json_encode($data, $options | JSON_THROW_ON_ERROR);
    }
}