<?php
require 'vendor/autoload.php';

spl_autoload_register(function ($class_name) {
    include 'core/' . $class_name . '.php';
});

if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();
