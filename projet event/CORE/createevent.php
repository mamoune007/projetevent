<?php
require('database_connect.php');

if (isset($_POST['submit'])) {
    $name_event = $_POST['name_event'];
    $description_event = $_POST['description_event'];
    $date_event = $_POST['date_event'];
    $numero_rue = $_POST['numero_rue'];
    $rue = $_POST['rue']; 
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];

    
    $query = "INSERT INTO localisation(numero, rue, ville, code_postal) VALUES (?, ?, ?, ?)";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "isss", $numero_rue, $rue, $ville, $code_postal);
    mysqli_stmt_execute($statement);

    
    $query2 = "INSERT INTO events(name_event, date, description) VALUES (?, ?, ?)";
    $statement2 = mysqli_prepare($connection, $query2);
    mysqli_stmt_bind_param($statement2, "sss", $name_event, $date_event, $description_event);
    mysqli_stmt_execute($statement2);

    
    mysqli_stmt_close($statement);
    mysqli_stmt_close($statement2);
    mysqli_close($connection);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>event</title>
</head>
<body>
    <main>
        <div class="container">
            <div  class="left" >
                <h1>Son propre Délire , son propre évenement</h1>
            </div>
            <div class="right">
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <label>Nom de l'evenement </label><br>
                    <input type="text" name="name_event"><br>
                    <label>date de l'évenement</label><br>
                    <input type="date" name="date_event"><br>
                    
                    <div>
                    <label>lieu de l'évenement</label><br>
                        <label>numero</label><br>
                        <input type="number" name="numero_rue"><br>
                        <label>rue</label><br>
                        <input type="text" name="rue"><br>
                        <label>ville</label><br>
                        <input type="text" name="ville"><br>
                        <label>code postal</label><br>
                        <input type="number" name="code_postal"><br>
                    </div>
                    <label> lieu de l'évenement</label><br>
                    <input  type="text" name="description_event"><br>
                    <input type="submit" name="submit">
                </form>
            </div>
        </div>
    </main>
    
</body>
</html>