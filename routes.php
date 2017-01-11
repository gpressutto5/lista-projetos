<?php

$router->get('', 'controller/list.php');
$router->get('editar', 'controller/editarprojeto.php');
$router->get('novo', 'controller/projeto.php');

$router->post('novo', 'controller/criar.php');
