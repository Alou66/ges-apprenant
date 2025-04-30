<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style5.css">
    <title>Document</title>
</head>
<body>
<div class="form_container">
    <h1>Créer une nouvelle promotion</h1>
    <p>Remplissez les informations ci-dessous pour créer une nouvelle promotion</p>

    <form action="index.php?page=ajoutpromo" method="post" enctype="multipart/form-data">
        <div class="nia">
            <label for="nom">Nom de la promotion</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div class="dat">
            <div>
                <label for="date_debut">Date de début</label>
                <input type="text" name="date_debut" id="date_debut" placeholder="YYYY-MM-DD">
            </div>
            <div>
                <label for="date_fin">Date de fin</label>
                <input type="text" name="date_fin" id="date_fin" placeholder="YYYY-MM-DD">
            </div>
        </div>

        <div class="phot">
            <label for="photo">Photo de la promotion</label>
            <div class="phot1">
                <input type="file" name="photo" id="photo">
                <p>Format JPG, PNG, Taille max 2MB</p>
            </div>
        </div>

        <div class="refl">
            <label>Référentiel :</label>
            <?php foreach ($referentielsActifs as $ref) : ?>
                <div class="checkbox_group">
                    <input type="checkbox" name="referentiels[]" value="<?= htmlspecialchars($ref) ?>" id="<?= htmlspecialchars($ref) ?>">
                    <label for="<?= htmlspecialchars($ref) ?>"><?= htmlspecialchars($ref) ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($erreurs)) : ?>
        <div class="errors">
            <ul>
                <?php foreach ($erreurs as $e) : ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($succes) : ?>
        <div class="success">Promotion ajoutée avec succès !</div>
    <?php endif; ?>


        <div class="bton">
            <button type="submit" class="cr">Créer la promotion</button>
        </div>
    </form>
</div>
</body>