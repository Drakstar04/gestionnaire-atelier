<?php $title = "Administration des réservations"; ?>

<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="display-6 fw-bold border-bottom pb-3"><i class="fa-solid fa-list-check me-2"></i> Gestion des réservations</h1>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Client</th>
                        <th>Atelier réservé</th>
                        <th>Date Atelier</th>
                        <th>Réservé le</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($reservations)){ ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucune réservation enregistrée.
                            </td>
                        </tr>
                    <?php }else{ ?>
                        <?php foreach($reservations as $res){ ?>
                            <tr>
                                <td class="ps-3 fw-bold"><?= $res->id_reservations ?></td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold"><?= htmlspecialchars($res->name_users) ?></span>
                                        <small class="text-muted"><?= htmlspecialchars($res->email_users) ?></small>
                                    </div>
                                </td>
                                <td class="text-primary fw-bold">
                                    <a href="index.php?controller=workshop&action=workshopDetail&id=<?= $res->id_workshops ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($res->title_workshops) ?>
                                    </a>
                                </td>
                                <td>
                                    <?= date("d/m/Y", strtotime($res->date_workshops)) ?>
                                </td>
                                <td class="small text-muted">
                                    <?= date("d/m/Y H:i", strtotime($res->date_reservations)) ?>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>