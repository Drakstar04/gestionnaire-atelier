<?php $title = "Mes Réservations"; ?>

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h1>Mes Réservations</h1>
        <p class="text-muted">Gérez vos inscriptions aux ateliers.</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="index.php?controller=reservation&action=reservationCreate" class="btn btn-primary">
            <i class="fa-solid fa-plus-circle me-2"></i> Réserver un atelier
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 mb-5">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fa-regular fa-calendar-check me-2"></i> Ateliers à venir</h5>
    </div>
    <div class="card-body p-0">
        <?php if(empty($upcomingReservations)){ ?>
            <div class="p-4 text-center text-muted">Aucune réservation en cours.</div>
        <?php }else{ ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Atelier</th>
                            <th>Date</th>
                            <th>Réservé le</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($upcomingReservations as $res){ ?>
                        <tr>
                            <td class="ps-4 fw-bold text-primary">
                                <?= htmlspecialchars($res->title_workshops) ?>
                            </td>
                            <td>
                                <i class="fa-regular fa-calendar me-2"></i>
                                <?= date("d/m/Y", strtotime($res->date_workshops)) ?>
                            </td>
                            <td class="text-muted small">
                                <?= date("d/m/Y", strtotime($res->date_reservations)) ?>
                            </td>
                            <td class="text-end pe-4">
                                <a href="index.php?controller=reservation&action=reservationCancel&id=<?= $res->id_reservations ?>" 
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                    <i class="fa-solid fa-xmark me-1"></i> Annuler
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

<div class="card shadow-sm border-0 bg-light">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0"><i class="fa-solid fa-history me-2"></i> Historique (Passés)</h5>
    </div>
    <div class="card-body p-0">
        <?php if(empty($pastReservations)){ ?>
            <div class="p-4 text-center text-muted">Aucun historique disponible.</div>
        <?php }else{ ?>
            <div class="table-responsive">
                <table class="table align-middle mb-0 text-muted">
                    <thead>
                        <tr>
                            <th class="ps-4">Atelier</th>
                            <th>Date événement</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pastReservations as $res){ ?>
                        <tr>
                            <td class="ps-4"><?= htmlspecialchars($res->title_workshops) ?></td>
                            <td><?= date("d/m/Y", strtotime($res->date_workshops)) ?></td>
                            <td><span class="badge bg-secondary">Terminé</span></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>