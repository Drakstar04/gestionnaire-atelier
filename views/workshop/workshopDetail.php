<?php $title = "Détail de l'atelier"; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php?controller=workshop&action=workshopList" class="text-decoration-none">
                        <i class="fa-solid fa-arrow-left me-1"></i> Ateliers
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= htmlspecialchars($workshop->title_workshops) ?>
                </li>
            </ol>
        </nav>

        <div class="card shadow border-0">
            <div class="card-body p-5">
                
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h1 class="fw-bold text-primary"><?= htmlspecialchars($workshop->title_workshops) ?></h1>
                    <span class="badge bg-info fs-6">
                        <i class="fa-solid fa-tag me-1"></i> <?= htmlspecialchars($workshop->name_categories) ?>
                    </span>
                </div>

                <div class="mb-4 text-muted border-bottom pb-4">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <i class="fa-regular fa-calendar-days me-2"></i>
                            <strong>Date :</strong> <?= date("d F Y", strtotime($workshop->date_workshops)) ?>
                        </div>
                        <div class="col-md-6 mb-2 text-md-end">
                            <strong>Disponibilité :</strong> 
                            <?php if($workshop->availability_workshops > 0){ ?>
                                <span class="text-success fw-bold">
                                    <i class="fa-solid fa-check-circle me-1"></i> 
                                    <?= $workshop->availability_workshops ?> places restantes
                                </span>
                            <?php }else{ ?>
                                <span class="text-danger fw-bold">
                                    <i class="fa-solid fa-circle-xmark me-1"></i> Complet
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h4 class="mb-3">Description de l'événement</h4>
                    <p class="description-text">
                        <?= nl2br(htmlspecialchars($workshop->description_workshops)) ?>
                    </p>
                </div>
                <div class="d-grid gap-2">
                    <?php if(isset($_SESSION["user"])) { ?>
                        <?php if($workshop->availability_workshops > 0) { ?>
                            <a href="index.php?controller=reservation&action=reservationCreate" class="btn btn-primary btn-lg py-3">
                                <i class="fa-solid fa-ticket me-2"></i> Réserver ma place
                            </a>
                        <?php } else { ?>
                            <button class="btn btn-secondary btn-lg py-3" disabled>
                                <i class="fa-solid fa-ban me-2"></i> Atelier Complet
                            </button>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="alert alert-warning text-center">
                            <i class="fa-solid fa-lock me-2"></i> Vous devez être connecté pour réserver. 
                            <a href="index.php?controller=auth&action=login" class="alert-link ms-2">Se connecter</a>
                       </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>