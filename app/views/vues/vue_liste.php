<!-- Filtres et recherche -->
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="parto">
                <div class="part1">
                    <h1 class="pm">Promotions</h1>
                    <span class="nant">120 apprenants</span>
                </div>
                
                <div class="slt0">
                    <div class="slt">
                        <form method="GET" action="index.php" class="mb-4">
                            <input type="hidden" name="page" value="proms2">
                            
                            <div class="rd1">
                                <div class="input-group">
                                    <input class="list" type="text" name="search" placeholder=" Rechercher une promotion..." 
                                           value="<?= htmlspecialchars($pagination_data['search']) ?>">
                                    <!-- <button type="submit" class="btn btn-primary"> -->
                                        <!-- <i class="fas fa-search"></i> -->
                                    </button> <!-- ✅ bouton bien ouvert/fermé -->
                                </div>

                                <div>
                                    <select name="referentiel" onchange="this.form.submit()">
                                        <option value="">Tous les référentiels</option>
                                        <?php foreach ($pagination_data['allReferentiels'] as $ref): ?>
                                            <option value="<?= htmlspecialchars($ref) ?>" 
                                                <?= $pagination_data['referentielFilter'] === $ref ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($ref) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div>
                                    <select name="statut" onchange="this.form.submit()">
                                        <option value="">Tous les statuts</option>
                                        <option value="actives" <?= $pagination_data['statutFilter'] === 'actives' ? 'selected' : '' ?>>
                                            Actives
                                        </option>
                                        <option value="inactives" <?= $pagination_data['statutFilter'] === 'inactives' ? 'selected' : '' ?>>
                                            Inactives
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div>
                        <a href="index.php?page=ajoutpromo" class="aj">Ajouter une promotion</a>
                    </div>
                </div>

                <?php if (!empty($pagination_data['search']) || !empty($pagination_data['referentielFilter']) || !empty($pagination_data['statutFilter'])): ?>
                    <div class="mt">
                        <a href="index.php?page=proms2" class="btn btn-secondary btn-sm mt-2">
                            <i class="fas fa-times-circle"></i> Réinitialiser les filtres
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="A">
                <div class="stats-container">
                    <!-- 4 stats -->
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div class="stat-info">
                            <h2><?= htmlspecialchars($pagination_data['stats']['apprenants']()) ?></h2>
                            <p>Apprenants</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-folder"></i></div>
                        <div class="stat-info">
                            <h2><?= htmlspecialchars($pagination_data['stats']['referentiels']()) ?></h2>
                            <p>Référentiels</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-info">
                            <h2><?= htmlspecialchars($pagination_data['stats']['stagiaires']()) ?></h2>
                            <p>Stagiaires</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                        <div class="stat-info">
                            <h2><?= htmlspecialchars($pagination_data['stats']['permanents']()) ?></h2>
                            <p>Permanents</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Résultats -->
            <?php if (empty($pagination_data['promotions'])): ?>
                <div class="alert alert-info">
                    Aucune promotion trouvée.
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th class="photo-cell">Photo</th>
                            <th>Nom</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Référentiels</th>
                            <th>Nombre d'apprenants</th>
                            <th>Statut</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagination_data['promotions'] as $promotion): ?>
                            <tr>
                                <td class="photo-cell">
                                    <img src="<?= htmlspecialchars($promotion['photo']) ?>" alt="Photo" class="avatar">
                                </td>
                                <td><?= htmlspecialchars($promotion['nom']) ?></td>
                                <td><?= $promotion['date_debut_formatted'] ?></td>
                                <td><?= $promotion['date_fin_formatted'] ?></td>
                                <td>
                                    <?php foreach ($promotion['referentiels'] as $ref): ?>
                                        <span class="tech-badge tech-web"><?= htmlspecialchars($ref) ?></span>
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $promotion['nombre_apprenants'] ?></td>
                                <td>
                                    <span class="badge <?= $promotion['active'] ? 'badge-active' : 'badge-inactive' ?>">
                                        <?= $promotion['active'] ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>
                                <td class="actions">
                                    <div class="or">
                                        <a href="index.php?page=detail_promotion&id=<?= $promotion['id'] ?>" 
                                           class="btn btn-sm btn-primary pt3">
                                            ...
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php if ($pagination_data['totalPages'] > 1): ?>
                    <div class="pagination">
                        <?php if ($pagination_data['currentPage'] > 1): ?>
                            <a href="index.php?page=proms2&currentPage=<?= $pagination_data['currentPage'] - 1 ?>&search=<?= urlencode($pagination_data['search']) ?>&referentiel=<?= urlencode($pagination_data['referentielFilter']) ?>&statut=<?= urlencode($pagination_data['statutFilter']) ?>">
                                Précédent
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $pagination_data['totalPages']; $i++): ?>
                            <a href="index.php?page=proms2&currentPage=<?= $i ?>&search=<?= urlencode($pagination_data['search']) ?>&referentiel=<?= urlencode($pagination_data['referentielFilter']) ?>&statut=<?= urlencode($pagination_data['statutFilter']) ?>"
                               <?= $i === $pagination_data['currentPage'] ? 'class="active"' : '' ?>>
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($pagination_data['currentPage'] < $pagination_data['totalPages']): ?>
                            <a href="index.php?page=proms2&currentPage=<?= $pagination_data['currentPage'] + 1 ?>&search=<?= urlencode($pagination_data['search']) ?>&referentiel=<?= urlencode($pagination_data['referentielFilter']) ?>&statut=<?= urlencode($pagination_data['statutFilter']) ?>">
                                Suivant
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
