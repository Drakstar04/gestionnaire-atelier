<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="assets/style.css" rel="stylesheet">
    <script defer src="../public/validation.js"></script>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container">
                <a class="navbar-brand" href="index.php?controller=workshop&action=workshopList">AtelierApp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=workshop&action=workshopList">Liste des ateliers</a>
                        </li>
                    </ul>

                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION["user"]) && !empty($_SESSION["user"])){ ?>
                        <?php if (isset($_SESSION["user"]["id_role"]) && $_SESSION["user"]["id_role"] == 1){ ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Administration</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?controller=admin&action=allCategories">Gérer les catégories</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="index.php?controller=admin&action=reservations">Toutes les réservations</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=reservation&action=reservationList">Mes réservations</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <div class="text-white mx-2">Bonjour, <?= htmlspecialchars($_SESSION["user"]["name_user"]) ?></div>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-danger btn-sm ms-2" href="index.php?controller=auth&action=logout">Se déconnecter</a>
                        </li>

                    <?php }else{ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=auth&action=login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="index.php?controller=auth&action=register">S'inscrire</a>
                        </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
            </nav>
    </header>

    <main class="container py-4 mb-5">

        <?php if(isset($_SESSION["error"])){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $_SESSION["error"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["error"]); ?>
        <?php } ?>

        <?php if(isset($_SESSION["success"])){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check me-2"></i> <?= $_SESSION["success"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["success"]); ?>
        <?php } ?>

        <?= $content ?>
    </main>

    <footer class="bg-dark text-light pt-5 pb-3 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold text-primary">AtelierApp</h5>
                    <p class="small text-secondary">
                        La plateforme de référence pour réserver vos événements et découvrir de nouveaux ateliers créatifs près de chez vous.
                    </p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold">Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="index.php?controller=workshop&action=workshopList" class="text-decoration-none text-light hover-primary">
                                Liste des ateliers
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="index.php?controller=auth&action=login" class="text-decoration-none text-light hover-primary">
                                Se connecter
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="index.php?controller=auth&action=register" class="text-decoration-none text-light hover-primary">
                                S'inscrire
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold">Contact</h5>
                    <ul class="list-unstyled text-secondary small">
                        <li class="mb-2">12 Rue des Développeurs, Paris</li>
                        <li class="mb-2">support@atelierapp.com</li>
                        <li class="mb-2">01 23 45 67 89</li>
                    </ul>
                </div>
            </div>

            <div class="row mt-3 border-top border-secondary pt-3">
                <div class="col-12 text-center">
                    <p class="small text-muted mb-0">&copy; 2026 AtelierApp. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>