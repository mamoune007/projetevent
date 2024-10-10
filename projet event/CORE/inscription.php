<?php
$serveur = "127.0.0.1";
$utilisateur = "root";
$mot_de_passe = "Hisauka17!";
$base_de_donnees = "projet_event";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];
    $statut = $_POST["statut"];

    if (empty($name) || empty($mail) || empty($password) || empty($phone_number) || empty($statut)) {
        echo 'Veuillez remplir tous les champs.';
    } else {
        $sql = "INSERT INTO users (name, mail, password, phone_number, statut) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $mail, $password, $phone_number, $statut);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Enregistrement réussi.";
        } else {
            echo "Erreur lors de l'enregistrement : " . mysqli_error($connexion);
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet"  href="styleinscription.css">
    <meta charset="UTF-8">
    <meta name="viewp">
    <title>Inscription</title>
</head>
<body>
    <main>
        <div class="container">
             <div class="title">
                 <h1>BIENVENU!!</h1>
            </div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <label>Name</label><br>
            <input type="text" name="name"><br>
            <label>Mail</label><br>
            <input type="email" name="mail"><br>
            <label>Password</label><br>
            <input type="password" name="password"><br>
            <label>Phone number</label><br>
            <input type="number" name="phone_number"><br>
            <label>Organizer</label>
            <input type="radio" name="statut" value="organizer">
            <label>Normal user</label>
            <input type="radio" name="statut" value="normal user" ><br>
            <input type="submit" name="submit" class="button">
        <div class="link" >
            vous avez déja un  compte? <a class="lien" href="login.php"> se connecter

            

            
        </form>
    </main>
</body>
</html>


