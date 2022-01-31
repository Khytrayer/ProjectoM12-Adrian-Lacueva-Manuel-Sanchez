<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password, pato) VALUES (:email, :password, :pato)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':pato', $_POST['pato']);

    if ($stmt->execute()) {
      $message = 'Usuario creado correctamente';
      header("Location: /projecte_m12/login.php");
    } else {
      $message = 'Error en la creación de usuario';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrar usuario</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style1.css">
  </head>
  <body>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrar usuario</h1>
    <span>¿Ya tienes una cuenta? <a href="login.php">Conéctate</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Entra tu email">
      <input name="password" type="password" placeholder="Entra tu contraseña">
      <input name="pato" type="text" placeholder="Entra el nombre de tu pato">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
