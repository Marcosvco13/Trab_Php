<?php
require_once('./class/class.Form_Materias.php');
require_once("header.php");

$Form_Materias =  new Form_Materias();

?>

<body>

    <?php require_once("menu.php") ?>

    <div class="content">
        <h2>Manutenção de Matérias</h2>
        <div>
            <table>

                <link rel="stylesheet" type="text/css" href="./css/tabela.css">

                <tr>
                    <td>ID DISCIPLINA</td>
                    <td>DESCRIÇÃO DISCIPLINA</td>
                </tr>

                <?php
                $rows = $Form_Materias->ListarMaterias();

                foreach ($rows as $registro) {
                    echo "<tr>";
                    echo "<td><a href=form_materia.php?alterarid=" . $registro['iddisciplina']  . '>'  . $registro['iddisciplina'] . "</td>";
                    echo "<td>" . $registro['dsdisciplina'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div>
            <?php
            if (isset($_GET['alterarid'])) {
                $materia = $Form_Materias->ListarMateria($_GET['alterarid']);
            ?>
                <form action="form_materia.php" method="POST">
                    <input type="hidden" name="iddisciplina" value="<?php echo $materia[0]['iddisciplina'] ?>" />
                    <input type="text" name="dsdisciplina" value="<?php echo $materia[0]['dsdisciplina'] ?>" maxlength="150" />
                    <input type="submit" value="Alterar" name="comando">
                    <input type="submit" value="Excluir" name="comando">
                </form>
            <?php

            }

            if (isset($_POST['comando']) && $_POST['comando'] == 'Alterar') {
                echo "Comandos para alterar o aluno ";
                $Form_Materias->AlterarMateria($_POST['iddisciplina'], $_POST['dsdisciplina']);
                header("location:form_materia.php?comando=alteracaook");
            } else if (isset($_POST['comando']) && $_POST['comando'] == 'Excluir') {
                echo "Comandos para excluir o aluno";
                $Form_Materias->excluirDisciplina($_POST['iddisciplina']);
                header("location:form_materia.php?comando=excluirok");
            } else if (isset($_POST['comando']) && $_POST['comando'] == 'Incluir') {
                echo "Comando para incluir o aluno";
                if (trim($_POST['dsdisciplina']) != '') {
                    echo htmlspecialchars($_POST['dsdisciplina']);
                    $Form_Materias->incluirDisciplina(htmlspecialchars($_POST['dsdisciplina']));
                    header("location:form_materia.php?comando=incluirok");
                }
            }
            ?>
        </div>
        <div>
            <hr>

            <h3>Incluir Disciplina</h3>

            <form action="form_materia.php" method="POST">
                <input type="text" name="dsdisciplina" value="" maxlength="150" />
                <input type="submit" value="Incluir" name="comando">
            </form>
            <?php

            ?>
        </div>
    </div>
</body>

</html>