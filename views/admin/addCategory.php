<?php $title = "Ajouter une catégorie"; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="fa-solid fa-plus me-2"></i> Nouvelle catégorie</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="index.php?controller=admin&action=addCategory" method="POST" id="form-category" novalidate>
                    <div class="mb-4">
                        <label for="name" class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Musique" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?controller=admin&action=allCategories" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success px-4">Créer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>