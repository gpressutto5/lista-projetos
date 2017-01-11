<?php
require "core/bootstrap.php";

$router = new Router();
require 'routes.php';

require Router::load('routes.php')
                ->direct(Request::uri());
