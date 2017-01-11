<html>
<head>
    <title>Adicionar Projeto</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <h1>Adicionar Projeto</h1>
    <?php
    $msg->display();
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="POST" action="/criar.php">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input id="nome" type="text" class="form-control" name="nome">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input id="descricao" type="text" class="form-control" name="descricao">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="template"> Gerar template inicial</label>
                </div>
                <button type="submit" class="btn btn-success btn-block">Criar</button>
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
