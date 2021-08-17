<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="historique.css">
    <title>Historique</title>
</head>

<body class="histo">
<?php

require_once "connect.php";


require_once "classes/LodgeManager.php";
require_once "classes/class.lodge.php";

$manager = new LodgeManager($db);
$lodge = $manager->getListLodge();
/* --------------------------------- DELETE --------------------------------- */
if (!empty($_GET['id'])) {
$lodge = $manager->getListId($_GET['id']);
$lodge=$manager->deleteLodge($lodge);
}
?>
    <header>
        <nav>
            <ul>
                <li><a href="historique.php">Historique</a></li>
                <li>|</li>
                <li><a href="form.php">Gestion des gîtes</a></li>
                <li>|</li>
                <li><a href="">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <fieldset>
       <legend>HISTORIQUE DES GîTES</legend>
        <div>
            <table class="histoire">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Localisation</th>
                        <th scope="col">Caractéristique</th>
                        <th scope="col">Images</th>
                        <th scope="col">Disponibilité</th>
                        <th scope="col">MODIFIER</th>
                        <th scope="col">SUPPRIMER</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($lodge as $data) : ?>
                        <tr>
                            <td><?= $data->getIdlodge(); ?></td>
                            <td><?= $data->getLodgename(); ?></td>
                            <td><?= $data->getLocation(); ?></td>
                            <td><?= $data->getSpecificity(); ?></td>
                            <td>Image</td>
                            <td>Disponibilité</td>
                            <td><button><a href="form.php?id=<?= $data->getIdlodge(); ?>"><img src="media/icons8-modifier.gif" width="40px" height="40px" alt="logo_modifier"></a></button></td>
                            <td><button><a href="historique.php?id=<?= $data->getIdlodge(); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ?'));"><img src="media/icons8-poubelle.gif" width="40px" height="40px" alt="logo_supprimer"> </a></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </fieldset>
        </main>
        
                 
</body>

</html>