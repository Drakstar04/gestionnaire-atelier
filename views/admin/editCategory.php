<?php $title = "Modifier la catégorie"; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="fa-solid fa-pen me-2"></i> Modifier la catégorie</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="index.php?controller=admin&action=editCategory&id=<?= $category->id_categories ?>" method="POST" id="form-category" novalidate>
                    <div class="mb-4">
                        <label for="name" class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= htmlspecialchars($category->name_categories) ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?controller=admin&action=allCategories" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-warning px-4">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>