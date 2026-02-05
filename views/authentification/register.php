<?php $title = "Inscription"; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">Créer un compte</h3>
            </div>
            <div class="card-body p-4">
                
                <form action="index.php?controller=auth&action=register" method="POST" id="form-register" novalidate>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemple@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-primary btn-lg" value="S'inscrire">
                    </div>
                </form>

            </div>
            <div class="card-footer text-center py-3">
                <p class="mb-0">Déjà inscrit ? <a href="index.php?controller=auth&action=login" class="text-decoration-none">Se connecter</a></p>
            </div>
        </div>
    </div>
</div>