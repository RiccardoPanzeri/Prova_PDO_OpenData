<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
    </head>
    <body>
        



    <?php
    include "mysql.php";//includo il file con le variabili contenenti le informazioni relative a mysql.

    try{
        $connessione =new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
        $connessione->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "<p class='connection'>Connessione al DB riuscita<br></p>";
    }catch(PDOException $e){
        echo "<p class='error'>Errore di connessione al DB: </p>".$e->getMessage();
    }

    //preparo una query SELECT:
    $stmt = $connessione->prepare("SELECT * FROM detenuti WHERE _id < :limite");
    $limite = 11;
    $stmt->bindParam(":limite", $limite);

    $stmt->execute();
    while($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='textDiv'><p class='para'><span class='titoloCampo'>ID:</span> {$row['_id']} | <span class='titoloCampo'>Tipologia:</span> {$row['detenuti_tipologia']} | <span class='titoloCampo'>Anno Rilevazione:</span> {$row['anno_rilevazione_detenuti']} | <span class='titoloCampo'>Casa Circondariale:</span> {$row['casa circondariale']} | <span class='titoloCampo'>Regione Nascita:</span> {$row['detenuti_regione_nascita']} | <span class='titoloCampo'>N° Detenuti:</span> {$row['detenuti']}</p></div>";
    };
    ?>

    </body>
</html>
