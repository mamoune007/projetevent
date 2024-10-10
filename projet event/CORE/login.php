<?php
session_start(); 

$serveur = "127.0.0.1";
$utilisateur = "root";
$mot_de_passe = "Hisauka17!";
$base_de_donnees = "projet_event";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $mail_saisi = $_POST["email_user"];
    $password_saisi = $_POST["password_user"];
    $mail_sql = "SELECT password FROM users WHERE mail = '$mail_saisi'"; // requete SQL
    $requete_mail_sql = mysqli_query($connexion, $mail_sql);
    $mail_verify = mysqli_num_rows($requete_mail_sql);
    $password_get = mysqli_fetch_assoc($requete_mail_sql);

    if (empty($mail_saisi) || empty($password_saisi)) {
        $connexion_user = FALSE;
        echo "<script type='text/javascript'>alert('Veuillez remplir toutes les données');</script>";
    } elseif ($mail_verify == 0) {
        echo "<script type='text/javascript'>alert('Il n'ya aucun compte avec ce mail');</script>";
    } elseif ($password_get["password"] == $password_saisi) {
        echo "Votre connexion a réussi";
        $connexion_user = TRUE; 
    } else {
        echo "<script type='text/javascript'>alert('votre password est erroné');</script>";
        $connexion_user = FALSE; 
    }
    if ($connexion_user == TRUE) {
        header('Location: index.php');
        exit;
        
    }

    
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet"  href="stylelogin.css">
</head>
<body>
    <main>
        <div class="container">
            <div class="left">
                <h1>C'est un plaisir de vous revoir ;)</h1>
            </div>
            
            <div class="right">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <label>Email</label><br>
                    <input type="email" name="email_user"><br>
                    <label>Mot de passe</label><br>
                    <input type="password" name="password_user"><br>
                    <input type="submit" name="submit" class ="submit">
                </form>
                <div class ="login">
                    vous n'avez pas de compte? <a class="lien" href="inscription.php">Inscription 
    
            </div>
        </div>
    </main>
    
</body>
</html>


        
        

             
        
    
        
        




        




    











    

