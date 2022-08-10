<?php

include('App/Controllers/CnpController.php');

use App\Controllers\CnpController;

/**
 * This is the router file.
 * It routes each request to their specific file.
 */

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/App/Views/cnp/input.php';
        break;

    case '/validate' :
        echo (new CnpController())->isCnpValid($_POST);
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/App/Views/404.php';
        break;
}