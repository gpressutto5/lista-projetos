<html>
<head>
    <title>Adicionar Projeto</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Projeto</h1>
    <?php
    $msg->display();
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="POST" action="/editar.php">
                <input type="hidden" value="<?= $nome ?>" name="nomeoriginal">
                <input type="hidden" value="<?= $descricao ?>" name="descricaooriginal">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input id="nome" type="text" class="form-control" name="nome" value="<?= $nome ?>">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input id="descricao" type="text" class="form-control" name="descricao" value="<?= $descricao ?>">
                </div>
                <button type="submit" class="btn btn-info btn-block">Editar</button>
                <a href="/" class="btn btn-default btn-block">Voltar</a>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>


<script src="public/js/jquery-2.1.4.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
</body>
</html>
