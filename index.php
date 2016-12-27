<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

$aulas = [];
$dirs = array_filter(glob('*'), 'is_dir');
foreach ($dirs as $dir){
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $path = $_SERVER['DOCUMENT_ROOT']."\\".$dir."\\";
    } else {
        $path = $_SERVER['DOCUMENT_ROOT']."/".$dir."/";
    }
    if (file_exists($path."index.php")) {
        $aulas[] = [
            'dir'  => rawurlencode($dir),
            'nome' => ucwords(strtolower($dir)),
            'read' => (file_exists($path."readme.md") ? htmlspecialchars(file_get_contents($path."readme.md")) : null)
        ];
    }
}
usort($aulas, function($a, $b) {
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
    <h1>Lista de Aulas</h1>
    <?php
    $msg->display();
    ?>
    <div class="list-group">
        <?php foreach ($aulas as $aula): ?>
            <a href="/<?= $aula['dir'].'/index.php' ?>" class="list-group-item">
                <h4 class="list-group-item-heading"><?= $aula['nome'] ?></h4>
                <?php if ($aula['read']): ?>
                    <p class="list-group-item-text"><?= $aula['read'] ?></p>
                <?php else: ?>
                    <p class="list-group-item-text">Crie um arquivo chamado 'readme.md' na pasta da aula com a descriação dela.</p>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php if(!count($aulas)): ?>
        <h1>Nenhuma aula encontrada</h1>
    <?php endif; ?>
    <a href="aula.php" class="btn btn-primary">Criar</a>
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