<?php
require 'vendor/autoload.php';
if (!session_id()) @session_start();
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

$projetos = [];
$dirs = array_filter(glob('*'), 'is_dir');
foreach ($dirs as $dir){
    $path = $_SERVER['DOCUMENT_ROOT']."/".$dir."/";

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
    <title>Lista de Projetos</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <h4 class="list-group-item-heading">
                        <a href="/<?= $projeto['dir'] . '/index.php' ?>"><?= $projeto['nome'] ?></a>
                        <span class="btn-group btn-group-xs pull-right">
                            <a class="btn btn-danger confirmation" href="delete.php?name=<?= $projeto['nome'] ?>">Apagar</a>
                            <a class="btn btn-info"href="editarprojeto.php?name=<?= $projeto['nome'] ?>">Editar</a>
                        </span>
                    </h4>
                <?php if ($projeto['read']): ?>
                    <p class="list-group-item-text"><?= $projeto['read'] ?></p>
                <?php else: ?>
                    <p class="list-group-item-text">Crie um arquivo chamado 'desc.md' na pasta do projeto com a descriação dele.</p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </div>
    <?php if(!count($projetos)): ?>
        <div class="panel">
            <div class="panel-body">
                <h4>Nenhum projeto encontrado</h4>
                <p>Para começar, crie seu primeiro projeto clicando no botão abaixo.</p>
            </div>
        </div>
    <?php endif; ?>
    <a href="projeto.php" class="btn btn-success btn-block">Criar</a>
</div>

<?php
include "footer.php";
?>


<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.confirmation').on('click', function () {
            return confirm('Tem certeza que deseja apagar TODOS OS ARQUIVOS deste projeto?');
        });
    });
</script>
</body>
</html>