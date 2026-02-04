<?php $title = "Gestion des catégories"; ?>

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h1 class="display-6 fw-bold"><i class="fa-solid fa-tags me-2"></i> Catégories</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="index.php?controller=admin&action=addCategory" class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i> Nouvelle catégorie
        </a>
    </div>
</div>

<?php if(isset($_SESSION["error"])){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $_SESSION["error"] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION["error"]); ?>
<?php } ?>

<?php if(isset($_SESSION["success"])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check me-2"></i> <?= $_SESSION["success"] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION["success"]); ?>
<?php } ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 table-col-id">#</th>
                    <th>Nom de la catégorie</th>
                    <th class="text-end pe-4 table-col-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($categories)){ ?>
                    <tr>
                        <td colspan="3" class="text-center table-empty-state">
                            Aucune catégorie trouvée.
                        </td>
                    </tr>
                <?php }else{ ?>
                    <?php foreach($categories as $cat){ ?>
                        <tr>
                            <td class="ps-4 fw-bold text-muted"><?= $cat->id_categories ?></td>
                            
                            <td class="fw-bold text-primary">
                                <?= htmlspecialchars($cat->name_categories) ?>
                            </td>
                            
                            <td class="text-end pe-4">
                                <a href="index.php?controller=admin&action=editCategory&id=<?= $cat->id_categories ?>" 
                                   class="btn btn-sm btn-outline-secondary me-1" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                
                                <a href="index.php?controller=admin&action=deleteCategory&id=<?= $cat->id_categories ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer la catégorie <?= $cat->name_categories ?> ?')" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>