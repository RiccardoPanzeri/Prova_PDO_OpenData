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
        //creo un istanza della classe PDO, che rappresenterà la connessione al DBMS: 
        $connessione =new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
        //configuro, mediante il metodo setAttribute(), la connessione in modo che sollevi un'eccezione specifica in caso di errori di connessione:
        $connessione->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //in caso di connessione riuscita, mostro un messaggio sul Browser:
        echo "<p class='connection'>Connessione al DB riuscita<br></p>";
    }catch(PDOException $e){//seci sono problemi, intercetto l'errore e visualizzo l'eccezione con il metodo getMessage():
        echo "<p class='error'>Errore di connessione al DB: </p>".$e->getMessage();
    }

    //preparo una query SELECT:
    $stmt = $connessione->prepare("SELECT * FROM detenuti WHERE _id < :limite");
    //dichiaro una variabile con un valore da assegnare successivamente alla parte "segnaposto" della query:
    $limite = 11;
    //assegno il valore della variabileal segnaposto:
    $stmt->bindParam(":limite", $limite);
    //eseguo la query:
    $stmt->execute();
    //utilizzo fetch() per ottenere i diversi record sottoformadi array associativi:  
    while($row =  $stmt->fetch(PDO::FETCH_ASSOC)){//per ciascun array associativo, creo un paragrafo da mostrare sul browser:
        echo "<div class='textDiv'><p class='para'><span class='titoloCampo'>ID:</span> {$row['_id']} | <span class='titoloCampo'>Tipologia:</span> {$row['detenuti_tipologia']} | <span class='titoloCampo'>Anno Rilevazione:</span> {$row['anno_rilevazione_detenuti']} | <span class='titoloCampo'>Casa Circondariale:</span> {$row['casa circondariale']} | <span class='titoloCampo'>Regione Nascita:</span> {$row['detenuti_regione_nascita']} | <span class='titoloCampo'>N° Detenuti:</span> {$row['detenuti']}</p></div>";
    };
    ?>

    </body>
</html>
