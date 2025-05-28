<?php
session_start();
require_once '../config/db.php';

 $hostname="localhost"; 
    $username="root";
    $password="root"; 
    $dbname="bdd_ryzek"; 
    $connexion =mysqli_connect($hostname, $username, $password, $dbname);

    $requete = "SELECT * FROM User ";
    $resultat=mysqli_query($connexion,$requete);
    if ( $resultat == FALSE ){
        echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
        die();
    }
    

    if (isset($_GET['delete'])) {
    $requete = $pdo->prepare("DELETE FROM User WHERE email = :email ");
    $requete->execute([
        'email'=> $_GET['delete'],
    ]);
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/global.css">
</head>
<body>
    <h1>Mes utilisateurs :</h1>

 
    
   
   

    <?php
       echo "<table>";
             echo   "<tr>";
                echo    "<td>Email</td>";
                echo    "<td>Nom</td>";
                echo    "<td>Prenom</td>";
                echo    "<td>Age</td>";
                echo    "<td>modifier</td>";
                echo    "<td>Supprimer</td>";
               echo "</tr>";
         while($UneLigne	= mysqli_fetch_assoc($resultat)){ 

            

               echo "<tr>";
                echo   '<td>'.$UneLigne['email'].'</td>';
                echo   '<td>'.$UneLigne['nom'].'</td>';
                echo   '<td>'.$UneLigne['prenom'].'</td>';
                echo   '<td>'.$UneLigne['age'].'</td>';
                echo   '<td>modifier</td>';
                echo   '<td><a href="?delete='.$UneLigne['email'].'">supprimer</a></td>';
                echo "</tr>";
           
                
                
                   
                    
                       
                        
                    
                 } 
            echo  "</table>";
        
    ?>
</body>
</html>
