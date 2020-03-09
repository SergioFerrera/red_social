<!-- Database Configuration File -->
<?php
session_start();
require_once('config.php');
$name=$_SESSION['name'];
$surname=$_SESSION['surname'];
$email=$_SESSION['email'];
$birthdate=$_SESSION['birthdate'];
$sexo=$_SESSION['sexo'];
$following=json_decode(base64_decode($_SESSION['following']));
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
        </nav>
    </div>

    <!-- Presentation & Register Form -->
    <div class="container">
        <div class="row mt-5">
            <!-- Presentation -->
            <div class="col-lg">
                <h2>Perfil</h2>
                <p></p>
                <?php
                    echo '<p><strong>Nombre:</strong> '.$name.'</p>';
                    echo '<p><strong>Apellidos:</strong> '.$surname.'</p>';
                    echo '<p><strong>Email:</strong> '.$email.'</p>';
                    echo '<p><strong>Fecha de nacimiento:</strong> '.$birthdate.'</p>';
                    echo '<p><strong>Sexo:</strong> '.$sexo.'</p>';
                    echo '<p><strong>Siguiendo:</strong> ';
                    if (count($following) > 1){
                        foreach ($following as $i=>$v) {
                            if ($i<count($following)-1)
                                echo $v. ', ';
                            else
                                echo $v;
                        }
                        echo '</p>';
                    }
                    elseif (count($following) == 1){
                        echo $following[0];
                        echo '</p>';
                    }
                ?>
                <form action="logged_in.php" method="post">
                    <div class="form-group">
                        <label for="followings">Sigue a gente!:</label>
                        <select name="followings[]" multiple class="form-control" required>
                        <?php
                            $sql = "SELECT id, name FROM users WHERE email != ?";
                            $stmselect = $db->prepare($sql);
                            $result = $stmselect->execute([$email]);
                            if($result){
                                if($stmselect->rowCount()>0){
                                    while ($row = $stmselect->fetch(PDO::FETCH_ASSOC)){
                                        echo '<option>'.$row["name"].'</option>';
                                    }
                                }
                                else{
                                    echo '<option>No existen más usuarios en la red social.</option>';
                                }
                            }
                            else{
                                echo '<option>Ha habido un error durante la carga.</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-dark" type="submit" name="follow">Seguir!</button>
                    </div>
                </form>
                <?php
                    if(isset($_POST['follow'])){
                        $array = $_POST['followings'];
                        $array_json = json_encode($array);
                        $array_base64 = base64_encode($array_json);
                        $sql = "UPDATE users SET following = ? WHERE email = ?";
                        $stmtinsert = $db->prepare($sql);
                        $result = $stmtinsert->execute([$array_base64, $email]);
                        if($result){
                            echo '<div class="alert alert-success" role="alert">Se han añadido los seguidores correctamente.</div>';
                        }
                        else{
                            echo '<div class="alert alert-danger" role="alert">Ha habido un error durante la adición de los seguidores.</div>';
                        }
                    }
                ?>
            </div>
            <!-- Register Form -->
            <div class="col-lg">
                <h2>Publicaciones</h2>
                <p></p>
                <form action="logged_in.php" method="post">
                    <div class="form-group">
                        <label for="post">Añade un nuevo post!:</label>
                        <textarea class="form-control" name="post" rows="3" maxlength="500"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-dark" type="submit" name="send_post">Enviar!</button>
                    </div>
                </form>
                <?php
                    if(isset($_POST['send_post'])){
                        $post = $_POST['post'];
                        $sql = "INSERT INTO posts (email, post) VALUES(?,?)";
                        $stmtinsert = $db->prepare($sql);
                        $result = $stmtinsert->execute([$email,$post]);
                        if($result){
                            echo '<div class="alert alert-success" role="alert">Se ha añadido correctamente el post.</div>';
                        }
                        else{
                            echo '<div class="alert alert-danger" role="alert">Ha habido un error durante la adición del post.</div>';
                        }
                    }
                ?>
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