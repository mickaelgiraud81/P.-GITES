<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>Connexion</title>
</head>

<body class="login">
  <h1>Espace administrateur</h1>
  <form action="" method="post">
    <h2>Connexion</h2>
    <div class= 'id'>
      <label for="identifiant">Identifiant : </label>
      <input type="text" id="identifiant" name="identifiant" required>
    </div>
    <div class ='mdp'>
      <label for="mdp">Mot de passe : </label>
      <input type="password" id="mdp" name="mdp" required>
    </div>
    <div id="submit">
      <input type="submit" value="Connexion">
    </div>
  </form>
  <?php

  if (isset($_POST['identifiant'])) {
    if ($_POST['mdp'] == 'admin01' && $_POST['identifiant'] == 'admin') {
      session_start();
      $_SESSION['login'] = "Admin";
      header('Location: form.php');
    } else {
      echo "Indentifiants incorrects";
    }
  }
  ?>
</body>

</html>