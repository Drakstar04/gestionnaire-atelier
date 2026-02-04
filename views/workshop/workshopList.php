<?php $title = "Liste des ateliers"; ?>

<div class="row mb-4">
    <div class="col-12 text-center">
        <h1 class="display-4 fw-bold">Nos Prochains Ateliers</h1>
        <p class="lead text-muted">Découvrez et réservez votre prochaine expérience créative.</p>
        <?php if (isset($_SESSION["user"]["id_role"]) && $_SESSION["user"]["id_role"] == 1){ ?>
            <div class="mb-3">
                <a href="index.php?controller=workshop&action=add" class="btn btn-success">
                    <i class="fa-solid fa-plus-circle me-2"></i> Ajouter un atelier
                </a>
            </div>
        <?php } ?>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form action="index.php" method="GET" class="d-flex">
                    <input type="hidden" name="controller" value="workshop">
                    <input type="hidden" name="action" value="workshopList">
                    
                    <input type="text" name="search" class="form-control me-2" 
                           placeholder="Rechercher un atelier" 
                           value="<?= isset($searchQuery) ? $searchQuery : '' ?>">
                    
                    <button type="submit" class="btn btn-dark">
                        <i class="fa-solid fa-search"></i>
                    </button>
                    
                    <?php if(isset($searchQuery) && !empty($searchQuery)){ ?>
                        <a href="index.php?controller=workshop&action=workshopList" class="btn btn-outline-secondary ms-2" title="Effacer">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <a href="index.php?controller=workshop&action=workshopList" 
               class="btn <?= ($currentCategory === null) ? 'btn-dark' : 'btn-outline-dark' ?> me-2 mb-2">
                Tous
            </a>
            
            <?php foreach($categories as $cat){ ?>
                <a href="index.php?controller=workshop&action=workshopList&category=<?= $cat->id_categories ?>" 
                   class="btn <?= ($currentCategory == $cat->id_categories) ? 'btn-primary' : 'btn-outline-primary' ?> me-2 mb-2">
                   <?= htmlspecialchars($cat->name_categories) ?>
                </a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">
    <?php if(empty($workshops)){ ?>
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fa-solid fa-info-circle me-2"></i> Aucun atelier disponible pour le moment.
            </div>
        </div>
    <?php }else{ ?>
        
        <?php foreach($workshops as $workshop){ ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    
                    <div class="card-header bg-transparent border-0 pt-3">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="badge bg-primary">
                                <i class="fa-solid fa-tag me-1"></i> <?= htmlspecialchars($workshop->name_categories) ?>
                            </span>

                            <?php if (isset($_SESSION["user"]["id_role"]) && $_SESSION["user"]["id_role"] == 1){ ?>
                                <div>
                                    <a href="index.php?controller=workshop&action=edit&id=<?= $workshop->id_workshops ?>" 
                                    class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fa-solid fa-pen me-1"></i> Modifier
                                    </a>
                                    <a href="index.php?controller=workshop&action=delete&id=<?= $workshop->id_workshops ?>" 
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fa-solid fa-trash me-1"></i> Supprimer
                                    </a>
                                </div>
                            <?php } ?>
                        </div>  
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?= htmlspecialchars($workshop->title_workshops) ?></h5>
                        
                        <h6 class="card-subtitle mb-3 text-muted">
                            <i class="fa-regular fa-calendar me-2"></i>
                            <?= date("d/m/Y", strtotime($workshop->date_workshops)) ?>
                        </h6>
                        
                        <p class="card-text description-truncate">
                            <?= htmlspecialchars($workshop->description_workshops) ?>
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-success fw-bold">
                                <i class="fa-solid fa-users me-1"></i> 
                                <?= $workshop->availability_workshops ?> places
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top-0 pb-3">
                        <div class="d-grid">
                            <a href="index.php?controller=workshop&action=workshopDetail&id=<?= $workshop->id_workshops ?>" class="btn btn-outline-primary">
                                Voir le détail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>