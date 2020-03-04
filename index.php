<?php
require_once('./components/config.php');

session_destroy(); 

$mAuth = new mAuth();

if (isset($_POST['bLogin'])) {
    $validation = $mAuth->validate($_POST['username'], $_POST['password']);
    echo ($validation);

    if ($validation == 1) {
        $_SESSION['userdata'] = $mAuth->getUserData($_POST['username']);
        header('location: home.php');
    } else {
        header('location: home.php?invalid=1');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $_SESSION['app_title'] ?> - Login</title>

<?php require_once('components/script.php'); ?>

        <link rel="stylesheet" href="css/index.css">

    </head>

    <body>

    <center>
        <div class="col-md-4 std-padding-top">
<?php if (isset($_GET['invalid'])) { ?>
                <div class="alert alert-danger" role="alert">
                    Usuário ou senha incorreto
                </div>
<?php }
if (isset($_GET['valid'])) {
    ?>
                <div class="alert alert-danger" role="alert">
                    Usuário ou senha incorreto
                </div>
<?php } ?>
        </div>

        <br><br>

        <div class="col-md-3 login" id="div-login">
            <h3>Login</h3>
            <form action="home.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuário">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                </div>
                <input type="submit" class="btn btn-primary" name="bLogin" value="Login">
                <br><br>
                <a href="">Esqueci minha senha</a>
            </form>
        </div>
    </center>

</body>



</html>