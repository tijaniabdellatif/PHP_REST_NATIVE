<?php

require_once __DIR__.'/vendor/autoload.php';
require_once './helpers/functions.php';
use Models\Response;


$response = new Response();
$response->setSuccess(false);
$response->setHttpStatusCode(404);
$response->addMessage('Test message 1');
$response->addMessage('test message 2');
$response->sendResponseData();
