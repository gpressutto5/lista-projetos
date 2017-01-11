<html>
<head>
    <title>Adicionar Projeto</title>
    <?php
        include "head.php";
    ?>
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
<script src="public/js/bootstrap.min.js"></script>
</body>
</html>
