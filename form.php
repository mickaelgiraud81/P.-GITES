<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="formmick.css">
    <title>Gestion des gîtes</title>

</head>

<body class="formulaire">

   

    <header>
        <nav class="nav">
            <ol>
                <li><a href="historique.php">Historique </a></li>
                <li>|</li>
                <li><a href="form.php">Gestion gites </a></li>
                <li>|</li>
                <li><a href="#">Deconnexion </a></li>
            </ol>
        </nav>
    </header>
    <?php
    require_once "connect.php";
    require_once "classes/LodgeManager.php";
    require_once "classes/class.lodge.php";

    /* -------------------------------- ADD IMAGE ------------------------------- */
    if (isset($_POST['submit'])) {
        $nbfichiersEnvoyes = count($_FILES['image']['name']); //compte le nombre dimage uploadé
        $dossier = '.\media\\'; //chemin de limage
        $extension = ['jpeg', 'jpg', 'gif', 'png', 'bmp']; // extension de limage

        for ($i = 0; $i < $nbfichiersEnvoyes; $i++) {
            $file_name = basename($_FILES['image']['name'][$i]); // basename pour recup que le nom
            $file_tmp = $_FILES['image']['tmp_name'][$i];
            $fichier_type = $_FILES['image']['type'][$i];
            $fichier_size = $_FILES['image']['size'][$i];

            $file = $dossier . $file_name;
            $return_name[] = $dossier . '\'' . $file_name;
            move_uploaded_file($file_tmp, $file);
        }
    }

    /* ------------------------------- INSERTION ------------------------------- */
    if (isset($_POST['submit']) && empty($_GET['id'])) {
        $lodge = new Lodge(array('idlodge' => 0, 'lodgename' => $_POST['name'], 'bedroom' => $_POST['bedroom'], 'bathroom' => $_POST['bathroom'], 'price' => $_POST['price'], 'arrival' => date('Y-m-d'), 'departure' => date('Y-m-d'), 'location' => $_POST['location'], 'category' => $_POST['category'], 'specificity' => implode(',', $_POST['box']), 'image' => serialize($return_name)));

        $manager = new LodgeManager($db);
        $manager->addLodge($lodge);
    }

    /* ----------------------------- PREREMPLISSAGE ----------------------------- */
    if (!empty($_GET['id'])) { // préremplir le formulaire avec edit
        $manager = new LodgeManager($db);
        $lodge = $manager->getListid($_GET['id']);
    }

    if (isset($_POST['submit']) && !empty($_GET['id'])) {
        $lodge = $manager->update($_GET['id']);
    }

    ?>

    <form action="form.php" method="POST" enctype="multipart/form-data">
    <div class="nom">
        <fieldset id='field'>
            <legend>Gestion des gîtes</legend>
            <div class='formulaire'>
                <div class='info'>
                    <div class="wrap">
                        <label for="name">Nom :
                        <input type="text" name="name" id="name" value="<?php if (isset($_GET['id'])) {
                        echo $lodge->getLodgename();} ?>"></label>
                    </div>

                    <div class="wrap"> 
                        <label for="location">Localisation :
                        <input type="text" name="location" id="location" value="<?php if (isset($_GET['id'])) {
                        echo $lodge->getLocation();} ?>"></label>
                    </div>

                    <div class="wrap">  
                        <label for="bedroom">Nombre de chambre :
                        <input type="number" name="bedroom" id="bedroom" min="0" max="99" step="1" value="<?php if (isset($_GET['id'])) {
                        echo $lodge->getBedroom();} ?>"></label>
                    </div>

                    <div class="wrap">     
                        <label for="bathroom">Nombre de salle de bain :
                        <input type="number" name="bathroom" id="bathroom" min="0" max="99" step="1" value="<?php if (isset($_GET['id'])) {
                        echo $lodge->getBathroom();} ?>"></label>
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                        $box = explode(',', ($lodge->getSpecificity()));} ?>

                    <div class="wrap"> 
                        <label for="price">Prix :</label>
                        <input type="number" name="price" id="price" min="0" max="110" step="1" value="<?php if (isset($_GET['id'])) {
                            echo $lodge->getPrice();} ?>">
                    </div>

                    <div class="specificity">
                        <label for="studio">Studio</label>
                        <input type="radio" name="box[]" value="Studio" <?php if (isset($_GET['id']) && in_array("Studio", $box)) {
                        echo "checked='checked'";} ?>>

                        <label for="T2">T2</label>
                        <input type="radio" name="box[]" value="T2" <?php if (isset($_GET['id']) && in_array("T2", $box)) {
                        echo "checked='checked'";} ?>>

                        <label for="T3">T3</label>
                        <input type="radio" name="box[]" value="T3" <?php if (isset($_GET['id']) && in_array("T3", $box)) {
                        echo "checked='checked'";} ?>>

                        <label for="T4">T4</label>
                        <input type="radio" name="box[]" value="T4" <?php if (isset($_GET['id']) && in_array("T4", $box)) {
                        echo "checked='checked'";} ?>>

                        <label for="garden">Jardin</label>
                        <input type="checkbox" name="box[]" value="Jardin" <?php if (isset($_GET['id']) && in_array("Jardin", $box)) {
                        echo "checked='checked'";} ?>>
                    </div> 
                    
                    <div class="wrap"> 
                    <select name="category" id="category">
                        <option value="Appartement" <?php if (isset($_GET['id'])) {
                            echo ($lodge->getCategory() == "Appartement") ? "selected" : "";} ?>>Appartement</option>
                        
                        <option value="Maison" <?php if (isset($_GET['id'])) {                         
                            echo ($lodge->getCategory() == "Maison") ? "selected" : "";} ?>>Maison</option>
                        
                        <option value="Chambre" <?php if (isset($_GET['id'])) {    
                            echo ($lodge->getCategory() == "Chambre") ? "selected" : "";} ?>>Chambre</option>
                        
                        <option value="Villa" <?php if (isset($_GET['id'])) {
                            echo ($lodge->getCategory() == "Villa") ? "selected" : "";} ?>>Villa</option>
                    </select>
                    </div>
                    <div class="wrap" id="image">    
                        <input type="file" name="image[]" id="" multiple>
                    </div>
                </div>

                    <div class="text_area">
                        <label for="description">Commentaire :</label>
                        <textarea name="descriptionun" id="description" maxlength="55" ></textarea>
                    </div>
            </div>
             <div class='enregistrer'>   
                <input type="submit" name='submit' value="Enregistrer">
            </div>
        </fieldset>
    </div>
    </form>

    <footer>

    </footer>
</body>

</html>