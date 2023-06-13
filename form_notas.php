<?php
require_once('./class/class.Form_Notas.php');
require_once('./class/class.Form_Aluno.php');
require_once('./class/class.Form_Materias.php');
require_once("./class/class.validacoesDeFormaulario.php");
require_once("./class/class.ValidacaoLogin.php");
require_once("header.php");

$Form_Notas =  new Form_Notas();
$Form_Aluno = new Form_Aluno();
$Form_Materia = new Form_Materias();
$validar = new ValidarLogin();

?>

<body>

    <?php require_once("menu.php") ?>

    <div class="content">
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
                echo '    <td><a href=form_notas.php?alterarid=' . $linha['idavaliacao'] . '>'  . $linha['idavaliacao'] . '</a> </td>';
                echo '    <td>' . $linha['nmaluno'] . '</td>';
                echo '    <td>' . $linha['dsdisciplina'] . '</td>';
                echo '    <td>' . $linha['nota'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>



        <?php
        if (isset($_GET['alterarid'])) {
            $nota = $Form_Notas->ListarNota($_GET['alterarid']);
        ?>
            <hr>
            Área de manutenção:
            <hr>
            <form action="form_notas.php" method="POST">
                <input type="hidden" name="idavaliacao" value="<?php echo $nota[0]['idavaliacao'] ?>" />
                <input type="text" name="nota" value="<?php echo $nota[0]['nota'] ?>" maxlength="10" />
                <input type="submit" value="Alterar" name="comando">
                <input type="submit" value="Excluir" name="comando">
            </form>

        <?php } ?>

        <hr>
        Lançamento de Nota:
        <hr>

        <form action="form_notas.php" method="post">

            <select name="idaluno">
                <?php
                $registroAlunos = $Form_Aluno->ListarAlunos();
                foreach ($registroAlunos as $linha) {
                    echo "<option value='" . $linha['idaluno'] . "'>" . $linha['nmaluno'] . "</option>";
                }
                ?>
            </select>

            <select name="iddisciplina">
                <?php
                $registroMaterias = $Form_Materia->ListarMaterias();
                foreach ($registroMaterias as $rows) {
                    echo "<option value='" . $rows['iddisciplina'] . "'>" . $rows['dsdisciplina'] . "</option>";
                }
                ?>
            </select>

            Nota: <input name="nota" type="text" maxlength="10" />

            <input type="submit" name="comando" value="Lançar" />
        </form>

        <?php

        if (isset($_POST['comando']) && $_POST['comando'] == "Alterar") {

            echo "Comandos para alterar nota ";
            $Form_Notas->alterarNota($_POST['idavaliacao'], $_POST['nota']);
            header("location:form_notas.php?comando=alteracaook");
        } else if (isset($_POST['comando']) && $_POST['comando'] == 'Excluir') {

            echo "Comandos para excluir nota";
            $Form_Notas->excluirNota($_POST['idavaliacao']);
            header("location:form_notas.php?comando=excluirok");
        } else if (isset($_POST['comando']) && $_POST['comando'] == 'Lançar') {

            echo "Comando para incluir nota";

            $nota = $_POST['nota'];
            $idaluno = $_POST['idaluno'];
            $iddisciplina = $_POST['iddisciplina'];

            if ($Form_Notas->incluirNota($nota, $idaluno, $iddisciplina)) {
                header("Location:form_notas.php");
            }
        }

        ?>

    </div>
</body>