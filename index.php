<!-- Database Configuration File & Session Start -->
<?php
require_once('config.php');
session_start();
?>

<!doctype html>

<html lang="es">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Red Social Master</title>
    <meta name="description" content="Red Social para el master de profesorado">
    <meta name="author" content="Sergio Ferrera de Diego">
    <!-- CSS dependencies -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
        id="bootstrap-css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <!-- Javascript dependencies -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- NavBar (Menu) -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f37b0a;">
            <!-- Logo -->
            <a class="navbar-brand" href="/"><img src="img/social_icon.svg" width="30" height="30"
                    class="d-inline-block align-top" alt="">
                Red Social
            </a>
            <!-- PHP code for check data on database -->
            <?php
                if(isset($_POST['login'])){
                    $email = $_POST['email_login'];
                    $password = $_POST['pass_login'];

                    $sql = "SELECT id, name, surname, email, birthdate, sexo FROM users WHERE email = ? AND password = ?";
                    $stmselect = $db->prepare($sql);
                    $result = $stmselect->execute([$email, $password]);

                    if($result){
                        $user = $stmselect->fetch(PDO::FETCH_ASSOC);
                        // Putting data from user database to Session variables
                        $_SESSION['name']=$user['name'];
                        $_SESSION['surname']=$user['surname'];
                        $_SESSION['email']=$user['email'];
                        $_SESSION['birthdate']=$user['birthdate'];
                        $_SESSION['sexo']=$user['sexo'];
                        if($stmselect->rowCount()>0){
                            header("Location: ./logged_in.php");
                            exit();
                        }
                        else{
                            echo '<div class="alert alert-danger" role="alert">No existe ese email y contraseña en la base de datos.</div>';
                        }
                    }
                    else{
                        echo '<div class="alert alert-danger" role="alert">Ha habido un error durante el inicio de sesión.</div>';
                    }
                }
            ?>
            <!-- Login Form -->
            <form action="index.php" method="post" class="form-inline ml-auto">
                <!-- Pattern is a regular expression for email input -->
                <input class="form-control mr-sm-2" type="email" placeholder="Email" aria-label="email_login"
                    name="email_login"
                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                    required>
                <input class="form-control mr-sm-2" type="password" placeholder="Contraseña" aria-label="password_login"
                    name="pass_login" required>
                <button class="btn btn-dark my-2 my-sm-0" type="submit" name="login">Entrar</button>
            </form>
        </nav>
    </div>

    <!-- Presentation & Register Form -->
    <div class="container">
        <!-- PHP code for insert data to database -->
        <?php
            if(isset($_POST['create'])){
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $email = $_POST['email_register'];
                $password = $_POST['pass_register'];
                $birthdate = $_POST['birthdate'];
                $sexo = $_POST['sexo'];
                
                $sql = "INSERT INTO users (name, surname, email, password, birthdate, sexo) VALUES(?,?,?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$name, $surname, $email, $password, $birthdate, $sexo]);

                if($result){
                    echo '<div class="alert alert-success" role="alert">Has sido registrado correctamente '  . $name . '.</div>';
                }
                else{
                    echo '<div class="alert alert-danger" role="alert">Ha habido un error durante el registro.</div>';
                }
            }
        ?>
        <div class="row mt-5">
            <!-- Presentation -->
            <div class="col-lg">
                <h5>Red Social para el Máster en Formación del Profesorado</h5>
                <p></p>
                <p>Esta red social ha sido desarrollada como trabajo para la asignatura de Aprendizaje y enseñanza de la
                    informática.</p>
                <p>Curso: 2019-2020</p>
                <img src="img/ull_logo.svg" alt="">
            </div>
            <!-- Register Form -->
            <div class="col-lg">
                <h4>Registrate</h4>
                <p></p>
                <form action="index.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <input type="text" class="form-control" placeholder="Nombre" aria-label="name" name="name"
                                required>
                        </div>
                        <div class="form-group col-lg">
                            <input type="text" class="form-control" placeholder="Apellidos" aria-label="surname"
                                name="surname" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <input class="form-control" type="email" placeholder="Email" aria-label="email_register"
                                name="email_register"
                                pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                                required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <input class="form-control" type="password" placeholder="Contraseña"
                                aria-label="password_register" name="pass_register" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <label for="birthdate">Fecha de nacimiento:</label>
                            <input class="form-control" type="date" aria-label="birthdate" name="birthdate" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <label for="sexo_input" aria-label="sexo">Sexo</label>
                            <div name="sexo_input">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" aria-label="mujer"
                                        name="mujer" value="mujer" required>
                                    <label class="form-check-label" for="mujer">Mujer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" aria-label="hombre"
                                        name="hombre" value="hombre" required>
                                    <label class="form-check-label" for="hombre">Hombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" aria-label="otro" name="otro"
                                        value="otro" required>
                                    <label class="form-check-label" for="otro">Otro</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <button class="btn btn-dark" type="submit" name="create">Registrarse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <footer class="page-footer font-small" style="background-color: #f37b0a;">
            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="https://sergioferrera.github.io/red_social/" style="color: inherit;">red_social.io</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>
</body>

</html>