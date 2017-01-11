<html>
<head>
    <title>Adicionar Projeto</title>
        <?php
            include "head.php";
        ?>
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
</body>
</html>
