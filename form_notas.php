<?php
require_once('./class/class.Form_Notas.php');
require_once("./class/class.validacoesDeFormaulario.php");
require_once("./class/class.ValidacaoLogin.php");
require_once("header.php");

$Form_Notas =  new Form_Notas();
$validar = new ValidarLogin();

?>

<body>

    <?php require_once("menu.php") ?>

    <div>
        <h2>Manutenção de Avaliação</h2>
        <br />
        <table>
            <tr class="titulo">
                <td>ID Avaliação</td>
                <td>Nome do Aluno</td>
                <td>Matéria</td>
                <td>Nota</td>
            </tr>

            <?php
            $registros = $Form_Notas->ListarNotas();
            foreach ($registros as $linha) {
                echo '<tr>';
                echo '    <td><a href=form_login.php?alterar=' . $linha['dslogin'] . '>'  . $linha['dslogin'] . '</a> </td>';
                echo '    <td>' . $linha['dssenha'] . '</td>';
                echo '    <td>' . $linha['idaluno'] . '</td>';
                echo '    <td>' . $linha['nmaluno'] . '</td>';
                echo '</tr>';
            }


            ?>

    </div>

</body>