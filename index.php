<?php
// je verifie que les donnée du formulaire ont été envoyés
if (!empty($_POST)) {
    $errors = [];
    // retrait de balises HTML pour se protéger de la faille XSS
    $name = trim(strip_tags($_POST["name"]));
    // Si pas d'erreurs, insertion de l'argonaute en bdd
    if (empty($errors)) {
        // Je récupère ma bdd - note: changer d'id et mettre mdp pour serveur en ligne !!!!!!
        $db = new PDO("mysql:host=localhost;dbname=mythologie", "root", "");
        // requète préparée pour éviter les injections SQL / insertion des données en bdd
        $query = $db->prepare("INSERT INTO argonaute (name) values (:name)");
        // fait le lien entre la données récupéré et la colonne dans laquelle elle sera inséré
        $query->bindParam(":name", $name);
        // recharge la page lorsque l'on envoie en bdd, donc lorsque l'on clic sur le bouton
        if ($query->execute()) {
            header("location: index.php");
        }
    }
}

// récupération de la base de données pour l'affichage
$db = new PDO("mysql:host=localhost;dbname=mythologie", "root", "");
$query = $db->query('SELECT name FROM argonaute');
$argonautes = $query->fetchAll(PDO::FETCH_ASSOC);

include("templates/header.php");
?>

<div class="container">
    <h2>Ajouter un(e) Argonaute</h2>
    <form class="new-member-form" action="index.php" method="post">
        <label for="inputName">Nom de l'Argonaute</label>
        <input type="text" id="inputName" name="name" value="<?= isset($name) ? $name : "" ?>">
        <input class="btn-validate" type="submit" value="Envoyer">
    </form>
    <h2>Membres de l'équipage :</h2>
    <section class="member-list">
        <?php
        foreach ($argonautes as $argonaute) {
        ?>
            <div class="member-item"><?= $argonaute["name"] ?></div>
        <?php
        }
        ?>
    </section>
</div>

<?php
include("templates/footer.php");
?>