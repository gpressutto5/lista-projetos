<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

$projetos = [];
$dirs = array_filter(glob('*'), 'is_dir');
foreach ($dirs as $dir){
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $path = $_SERVER['DOCUMENT_ROOT']."\\".$dir."\\";
    } else {
        $path = $_SERVER['DOCUMENT_ROOT']."/".$dir."/";
    }
    if (file_exists($path."index.php")) {
        $projetos[] = [
            'dir'  => rawurlencode($dir),
            'nome' => $dir,
            'read' => (file_exists($path."desc.md") ? htmlspecialchars(file_get_contents($path."desc.md")) : null)
        ];
    }
}
usort($projetos, function($a, $b) {
    return strnatcmp($a['nome'], $b['nome']);
});
?>
<html>
<head>
    <title>Lista de Aulas</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        html {
        position: relative;
        min-height: 100%;
        }
        body {
        /* Margin bottom by footer height */
        margin-bottom: 60px;
            background-color: #e1ffff;
        }
        .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 60px;
        background-color: #8bc0cc;
        }
        .container {
            width: auto;
            max-width: 680px;
            padding: 0 15px;
        }
        h1,
        .container .text-muted {
            margin: 20px 0;
            color: #4e6f79;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Lista de Projetos</h1>
    <?php
    $msg->display();
    ?>
    <div class="list-group">
        <?php foreach ($projetos as $projeto): ?>
            <li class="list-group-item clearfix">
                <a href="/<?= $projeto['dir'] . '/index.php' ?>">
                    <h4 class="list-group-item-heading">
                        <?= $projeto['nome'] ?>
                        <a class="btn btn-xs btn-info pull-right" href="editarprojeto.php?name=<?= $projeto['nome'] ?>">Editar</a>
                    </h4>
                </a>
                <?php if ($projeto['read']): ?>
                    <p class="list-group-item-text"><?= $projeto['read'] ?></p>
                <?php else: ?>
                    <p class="list-group-item-text">Crie um arquivo chamado 'desc.md' na pasta do projeto com a descriação dele.</p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </div>
    <?php if(!count($projetos)): ?>
        <h1>Nenhuma aula encontrada</h1>
    <?php endif; ?>
    <a href="projeto.php" class="btn btn-primary">Criar</a>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Voce está usando a versão <?= phpversion() ?> do php.</p>
    </div>
</footer>


<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>