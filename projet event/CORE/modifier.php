<?php
require('database_connect.php');

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
    
    // Fetch existing event details
    $query = "SELECT e.name_event, e.date, e.description, l.numero, l.rue, l.ville, l.code_postal 
              FROM events e 
              JOIN localisation l ON e.id = l.event_id 
              WHERE e.id = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("i", $event_id);
    $statement->execute();
    $statement->bind_result($name_event, $date_event, $description_event, $numero_rue, $rue, $ville, $code_postal);
    $statement->fetch();
    $statement->close();
}

if (isset($_POST['submit'])) {
    $name_event = $_POST['name_event'];
    $description_event = $_POST['description_event'];
    $date_event = $_POST['date_event'];
    $numero_rue = $_POST['numero_rue'];
    $rue = $_POST['rue'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    
    // Update localisation
    $query = "UPDATE localisation SET numero = ?, rue = ?, ville = ?, code_postal = ? WHERE event_id = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("isssi", $numero_rue, $rue, $ville, $code_postal, $event_id);
    $statement->execute();
    
    // Update event
    $query2 = "UPDATE events SET name_event = ?, date = ?, description = ? WHERE id = ?";
    $statement2 = $connection->prepare($query2);
    $statement2->bind_param("sssi", $name_event, $date_event, $description_event, $event_id);
    $statement2->execute();
    
    $statement->close();
    $statement2->close();
    $connection->close();

    header("Location: event_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'événement</title>
</head>
<body>
    <main>
        <div class="container">
            <div class="left">
                <h1>Modifier l'événement</h1>
            </div>
            <div class="right">
                <form action="<?php echo $_SERVER["PHP_SELF"] . '?id=' . $event_id;?>" method="post">
                    <label>Nom de l'événement</label><br>
                    <input type="text" name="name_event" value="<?php echo htmlspecialchars($name_event); ?>"><br>
                    <label>Date de l'événement</label><br>
                    <input type="date" name="date_event" value="<?php echo htmlspecialchars($date_event); ?>"><br>
                    
                    <div>
                        <label>Lieu de l'événement</label><br>
                        <label>Numéro</label><br>
                        <input type="number" name="numero_rue" value="<?php echo htmlspecialchars($numero_rue); ?>"><br>
                        <label>Rue</label><br>
                        <input type="text" name="rue" value="<?php echo htmlspecialchars($rue); ?>"><br>
                        <label>Ville</label><br>
                        <input type="text" name="ville" value="<?php echo htmlspecialchars($ville); ?>"><br>
                        <label>Code postal</label><br>
                        <input type="number" name="code_postal" value="<?php echo htmlspecialchars($code_postal); ?>"><br>
                    </div>
                    <label>Description de l'événement</label><br>
                    <input type="text" name="description_event" value="<?php echo htmlspecialchars($description_event); ?>"><br>
                    <input type="submit" name="submit" value="Modifier">
                </form>
            </div>
        </div>
    </main>
</body>
</html>


