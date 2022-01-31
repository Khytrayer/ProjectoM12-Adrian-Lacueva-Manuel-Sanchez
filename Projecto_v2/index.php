<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password, pato FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Conexión a Clicking Duck</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style1.css">
  </head>
  <body>
    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user['email']; ?>
      <br> Conectado correctamente
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Inicio de sesión</h1>

      <a href="login.php">Conectar</a> ||
      <a href="signup.php">Crear cuenta</a>
    <?php endif; ?>
  </body>
</html>
