<?php
session_start();
require_once '../config/db.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // on récupère les données transmise par le formulaire
    $email= $_POST['email'];
    $nom= $_POST['nom'];
    $prenom= $_POST['prenom'];
    $age= $_POST['age'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $erreur = "Les mots de passe ne correspondent pas.";// verification du mot de passe
    } else {
        // on vérifie que l'utilisateur n'a pas déja un compte 
        $check = $pdo->prepare("SELECT * FROM User WHERE email = :email");
        $check->execute(['email' => $email]);

        if ($check->fetch()) {
            $erreur = "Il y a déja un compte lié a cette email";
        } else {
            //on entre les informations dans la BDD
            
            $insert = $pdo->prepare("INSERT INTO User (email, nom, prenom, password, age) VALUES (:email, :nom, :prenom, :password, :age)");
            $insert->execute([
                'email' => $email,
                'nom'=> $nom,
                'prenom'=>$prenom,
                'password'=> $password,
                'age'=>$age
            ]);
            header("Refresh:2; url=connexion.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Créer un compte</h1>


    

    <form method="POST">
        <label>Nom : <input type="text" name="nom" required></label><br>
        <label>Prénom : <input type="text" name="prenom" required></label><br>
        <label>Âge : <input type="text" name="age" required></label><br>
        <label>Email : <input type="text" name="email" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <label>Confirmer mot de passe : <input type="password" name="confirm" required></label><br>
        <button type="submit">S'inscrire</button>
    </form>
    <?=  $erreur ?>
    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
</body>
</html>
