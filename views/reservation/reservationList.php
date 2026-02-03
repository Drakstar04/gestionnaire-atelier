<?php $title = "Mes Réservations"; ?>

<div class="row mb-4">
    <div class="col-md-8">
        <h1>Mes Réservations</h1>
        <p class="text-muted">Retrouvez ici l'historique de vos inscriptions.</p>
    </div>
</div>

<div class="row">
    <?php if(empty($reservations)){ ?>
        <div class="col-12">
            <div class="alert alert-info text-center">
                Vous n'avez aucune réservation pour le moment.
            </div>
        </div>
    <?php }else{ ?>
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Atelier</th>
                                    <th>Date de l'événement</th>
                                    <th>Réservé le</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reservations as $res){ ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">
                                        <?= htmlspecialchars($res->title_workshops) ?>
                                    </td>
                                    <td>
                                        <i class="fa-regular fa-calendar me-2"></i>
                                        <?= date("d/m/Y", strtotime($res->date_workshops)) ?>
                                    </td>
                                    <td class="text-muted small">
                                        <?= date("d/m/Y à H:i", strtotime($res->date_reservations)) ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>