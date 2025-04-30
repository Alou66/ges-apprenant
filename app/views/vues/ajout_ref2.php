<div class="modal">
  <h2>Ajouter un référentiel à une promotion</h2>

  <?php if (isset($success)): ?>
    <p style="color: <?= strpos($success, 'succès') !== false ? 'green' : 'red' ?>"><?= $success ?></p>
  <?php endif; ?>

  <form action="index.php?page=ajoutref2" method="post" enctype="multipart/form-data">
    <label for="libelle">Libellé référentiel</label>
    <select name="libelle" id="libelle">
      <?php foreach ($referentiels as $ref): ?>
        <option value="<?= htmlspecialchars($ref['nom']) ?>">
          <?= htmlspecialchars($ref['nom']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label>Promotions actives</label>
    <div class="checkbox-group">
      <?php foreach ($promotions_actives as $promo): ?>
        <label>
          <input type="checkbox" name="promos[]" value="<?= htmlspecialchars($promo['nom']) ?>">
          <?= htmlspecialchars($promo['nom']) ?>
        </label><br>
      <?php endforeach; ?>
    </div>

    <button type="submit">Terminer</button>
  </form>
</div>
