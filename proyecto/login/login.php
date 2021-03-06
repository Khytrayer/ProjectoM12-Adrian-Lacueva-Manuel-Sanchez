<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: proyecto/juego.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password, pato FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /proyecto/juego.php");
    } else {
      $message = 'Usuario o contraseña incorrectos';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Conectar usuario</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../estilos/estilosLogin.css">
  </head>
  <body>
    

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Conectar usuario</h1>
    <span>¿No tienes cuenta? <a href="signup.php">Registrate</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Entra tu email">
      <input name="password" type="password" placeholder="Entra tu contraseña">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
