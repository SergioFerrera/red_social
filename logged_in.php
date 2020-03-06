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
        </nav>
    </div>

    <!-- Presentation & Register Form -->
    <div class="container">
        <div class="row mt-5">
            <!-- Presentation -->
            <div class="col-lg">
                <h5>Red Social para el Máster en Formación del Profesorado</h5>
                <p></p>
                <?php
                    $name=$_GET['name'];
                    $surname=$_GET['surname'];
                    $email=$_GET['email'];
                    $birthdate=$_GET['birthdate'];
                    $sexo=$_GET['sexo'];
                    echo '<p><strong>Nombre:</strong> '.$name.'</p>';
                    echo '<p><strong>Apellidos:</strong> '.$surname.'</p>';
                    echo '<p><strong>Email:</strong> '.$email.'</p>';
                    echo '<p><strong>Fecha de nacimiento:</strong> '.$birthdate.'</p>';
                    echo '<p><strong>Sexo:</strong> '.$sexo.'</p>';
                ?>
            </div>
            <!-- Register Form -->
            <div class="col-lg">
                <h4>Publicaciones</h4>
                <p></p>
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