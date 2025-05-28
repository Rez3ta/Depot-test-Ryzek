<?php
session_start();
require_once '../config/db.php';
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])&& $_POST['password']){

        $email=$_POST['email'];
        $check = $pdo->prepare("SELECT * FROM User WHERE email = :email");
        $check->execute(['email' => $email]);

        if ($check->fetch()) {
        $user = $check->fetchAll(PDO::FETCH_ASSOC);
        foreach ($user as $user):
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom']=$user['prenom'];
        endforeach;
        header('Location: ../public/main.php');
        } 
        else {
            
        $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Se connecter</h1>

    <?php if ($erreur): ?>
        <p style="color:red"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email : <input type="text" name="email" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <button type="submit">Connexion</button>
    </form>
<?= $erreur ?>
    <p>Pas encore de compte ? <a href="register.php">S'inscrire</a></p>
</body>
</html>
