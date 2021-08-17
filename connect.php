 <?php
try {
    $db = new PDO('mysql:host=localhost;dbname=lodge_db', 'root');
} catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
}
?> 