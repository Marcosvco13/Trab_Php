<?php
require_once("header.php");
require_once("./class/class.validacoesDeFormaulario.php");
require_once("./class/class.ValidacaoLogin.php");
require_once("./class/class.Form_Login.php");

$Form_login = new Form_Login();
$validar = new ValidarLogin();

?>

<body>
    <link rel="stylesheet" type="text/css" href="css/form_login.css">
    <?php require_once("menu.php") ?>

    <div class="content">
        <h2>Manutenção de Logins</h2>
        <br />
        <table>
            <tr class="titulo">
                <td>Login</td>
                <td>Senha</td>
                <td>ID do Aluno</td>
                <td>Nome do Aluno</td>
            </tr>
            <?php

            $registros  = $Form_login->listarLogins();

            foreach ($registros as $linha) {
                echo '<tr>';
                echo '    <td><a href=form_login.php?alterar=' . $linha['dslogin'] . '>'  . $linha['dslogin'] . '</a> </td>';
                echo '    <td>' . $linha['dssenha'] . '</td>';
                echo '    <td>' . $linha['idaluno'] . '</td>';
                echo '    <td>' . $linha['nmaluno'] . '</td>';
                echo '</tr>';
            }

            ?>
        </table>

        <?php
        if (isset($_GET['alterar'])) {
        ?>
            <hr>
            Área de manutenção:
            <hr>

            <form action="form_login.php" method="post">
                Login: <input name="dslogin" type="text" maxlength="20" readonly value="<?php echo $_GET['alterar'] ?>">
                Senha: <input name="dssenha" type="password" maxlength="20" value="">
                <?php
                if ($_GET['alterar'] != 'admin') {
                    echo '<input type="submit" name="comando" value="Excluir Acesso" />';
                }
                ?>
                <input type="submit" name="comando" value="Alterar Senha" />
            </form>
        <?php } ?>

        <hr>
        Inclur Novo Registro:
        <hr>

        <form action="form_login.php" method="post">
            Login: <input name="dslogin" type="text" maxlength="20" />
            Senha: <input name="dssenha" type="password" maxlength="20" />
            <select name="idaluno">
                <?php
                $registro = $Form_login->listarAlunosNaoRelacionados();

                foreach ($registro as $linha) {
                    echo "<option value='" . $linha['idaluno'] . "'>" . $linha['nmaluno'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="comando" value="Cadastrar" />
        </form>

        <?php
        if (isset($_POST['comando']) && ($_POST['comando'] == "Cadastrar")) {
            echo "CÓDIGO PARA FAZER O INSERT";

            $dslogin = htmlspecialchars($_POST['dslogin']);
            $dssenha = md5($_POST['dssenha']);
            $idaluno = $_POST['idaluno'];

            if ($Form_login->incluirLogin($dslogin, $dssenha, $idaluno)) {
                header("Location:form_login.php");
            }
        } else if (isset($_POST['comando']) && ($_POST['comando'] == "ExcluirAcesso")) {
            echo "Estou na área de exclusão";
            $Form_login->excluirAcesso($_POST['dslogin']);
            header("Location:form_login.php");
        } else if (isset($_POST['comando']) && ($_POST['comando'] == "AlterarSenha")) {
            echo "Estou na área de alteração de senha";
            $Form_login->alterarSenha($_POST['dslogin'], md5($_POST['dssenha']));
            header("Location:form_login.php");
        }

        ?>

    </div>
</body>

</html>