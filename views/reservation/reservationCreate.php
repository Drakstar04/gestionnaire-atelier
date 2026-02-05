<?php $title = "Nouvelle réservation"; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fa-solid fa-ticket me-2"></i> Réserver une place</h4>
            </div>
            <div class="card-body p-4">

                <form action="index.php?controller=reservation&action=reservationCreate" method="POST">
                    
                    <div class="mb-4">
                        <label for="workshop_id" class="form-label fw-bold">Choisir un atelier</label>
                        <select name="workshop_id" id="workshop_id" class="form-select form-select-lg" required>
                            <option value="" disabled <?= $selectedId === null ? "selected" : "" ?>>Sélectionner</option>
                            
                            <?php foreach($workshops as $ws){ ?>
                                <option value="<?= $ws->id_workshops ?>" 
                                    <?= ($selectedId == $ws->id_workshops) ? "selected" : "" ?>>
                                    
                                    <?= htmlspecialchars($ws->title_workshops) ?> 
                                    (<?= date("d/m/Y", strtotime($ws->date_workshops)) ?>)
                                    - Reste <?= $ws->availability_workshops ?> places
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            Confirmer la réservation
                        </button>
                        <a href="index.php?controller=reservation&action=reservationList" class="btn btn-outline-secondary">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>