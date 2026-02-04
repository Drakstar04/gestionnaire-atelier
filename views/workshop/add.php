<?php $title = "Ajouter un atelier"; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0"><i class="fa-solid fa-plus-circle me-2"></i> Créer un nouvel atelier</h3>
            </div>
            <div class="card-body p-4">
                
                <form action="index.php?controller=workshop&action=add" method="POST">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre de l'atelier</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Catégorie</label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="" selected disabled>Choisir une catégorie</option>
                                <?php foreach($categories as $cat){ ?>
                                    <option value="<?= $cat->id_categories ?>">
                                        <?= htmlspecialchars($cat->name_categories) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date de l'événement</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="availability" class="form-label">Nombre de places</label>
                        <input type="number" name="availability" id="availability" class="form-control" required min="1">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Détails de l'atelier..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?controller=workshop&action=workshopList" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-check me-2"></i> Créer l'atelier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>