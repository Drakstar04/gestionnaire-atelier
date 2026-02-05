<?php $title = "Modification de l'atelier <?= htmlspecialchars($workshop->title_workshops) ?>"; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark">
                <h3 class="mb-0"><i class="fa-solid fa-pen-to-square me-2"></i> Modifier l'atelier</h3>
            </div>
            <div class="card-body p-4">
                
                <form action="index.php?controller=workshop&action=edit&id=<?= $workshop->id_workshops ?>" method="POST" id="form-workshop" novalidate data-mode="edit">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre de l'atelier</label>
                        <input type="text" name="title" id="title" class="form-control" 
                               value="<?= htmlspecialchars($workshop->title_workshops) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Catégorie</label>
                            <select name="category" id="category" class="form-select" required>
                                <?php foreach($categories as $cat){ ?>
                                    <option value="<?= $cat->id_categories ?>" 
                                        <?= ($workshop->id_categories == $cat->id_categories) ? "selected" : "" ?>>
                                        <?= htmlspecialchars($cat->name_categories) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date de l'événement</label>
                            <input type="date" name="date" id="date" class="form-control" 
                                   value="<?= $workshop->date_workshops ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="availability" class="form-label">Nombre de places</label>
                        <input type="number" name="availability" id="availability" class="form-control" 
                               value="<?= $workshop->availability_workshops ?>" required min="0" max="30">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required><?= htmlspecialchars($workshop->description_workshops) ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?controller=workshop&action=workshopList" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-save me-2"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>