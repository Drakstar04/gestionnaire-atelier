<?php $title = "Connexion"; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mb-0">Connexion</h3>
            </div>
            <div class="card-body p-4">

                <form action="index.php?controller=auth&action=login" method="POST">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemple@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-dark btn-lg" value="Se connecter">
                    </div>
                </form> 

            </div>
            <div class="card-footer text-center py-3">
                <p class="mb-0">Pas encore de compte ? <a href="index.php?controller=auth&action=register" class="text-decoration-none">S'inscrire</a></p>
            </div>
        </div>
    </div>
</div>