// Affichage erreur
function setError(input, message) {
    input.classList.add("is-invalid");
    input.classList.remove("is-valid");
    
    let errorDiv = input.nextElementSibling;
    if (!errorDiv || !errorDiv.classList.contains("invalid-feedback")) {
        errorDiv = document.createElement("div");
        errorDiv.className = "invalid-feedback";
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
    }
    errorDiv.innerText = message;
}

// Affichage succès
function setSuccess(input) {
    input.classList.add("is-valid");
    input.classList.remove("is-invalid");
}





// Vérification du formulaire d'inscription ou de connexion

const authForm = document.getElementById("form-register") || document.getElementById("form-login");

if (authForm) {
    authForm.addEventListener("submit", function (e) {
        let isValid = true;

        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const name = document.getElementById("name");

        // Vérif nom
        if (name) {
            if (name.value.trim().length < 2) {
                setError(name, "Le nom doit contenir au moins 2 caractères.");
                isValid = false;
            } else if (name.value.trim().length > 30) {
                setError(name, "Le nom ne doit pas contenir plus de 30 caractères.");
                isValid = false;
            } else {
                setSuccess(name);
            }
        }

        // Vérif email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            setError(email, "Email invalide.");
            isValid = false;
        } else {
            setSuccess(email);
        }

        // Vérif mot de passe
        if (password.value.length < 8) {
            setError(password, "Le mot de passe doit faire 8 caractères minimum.");
            isValid = false;
        } else {
            setSuccess(password);
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
}




// Vérification du formulaire atelier (ADD/EDIT)

const workshopForm = document.getElementById("form-workshop");

if (workshopForm) {
    workshopForm.addEventListener("submit", function (e) {
        let isValid = true;

        const mode = workshopForm.dataset.mode;
        const title = document.getElementById("title");
        const category = document.getElementById("category");
        const availability = document.getElementById("availability");
        const date = document.getElementById("date");
        const description = document.getElementById("description");

        // Vérif titre
        if (title.value.trim() === "") {
            setError(title, "Veuillez entrer un titre.");
            isValid = false;
        } else if (title.value.length < 4) {
            setError(title, "Le titre doit contenir au moins 4 caractères.");
            isValid = false;
        } else if (title.value.length > 100) {
            setError(title, "Le titre ne doit pas contenir plus de 100 caractères.");
            isValid = false;
        } else {
            setSuccess(title);
        }

        // Vérif qu'une catégorie est associer a l'atelier
        if (category.value === "") {
            setError(category, "Une catégorie doit etre associée.");
            isValid = false;
        } else {
            setSuccess(category);
        }

        // Vérif disponibilitée
        if (availability.value === "") {
            setError(availability, "Veuillez indiquer un nombre de places.");
            isValid = false;
        } else if (mode === "add" && availability.value < 1) {
            setError(availability, "Il faut au moins 1 place pour créer un atelier.");
            isValid = false;
        } else if (mode === "edit" && availability.value < 0) {
            setError(availability, "Le nombre de places ne peut pas être négatif.");
            isValid = false;
        } else if (availability.value > 30) {
            setError(availability, "Le nombre de places ne peut pas être supérieur à 30.");
            isValid = false;
        } else {
            setSuccess(availability);
        }

        // Vérif que la date n'est pas passée
        const today = new Date().setHours(0,0,0,0);
        const selectedDate = new Date(date.value).setHours(0,0,0,0);

        if(date.value === ""){
            setError(date, "Veillez entrer une date.");
            isValid = false;
        } else if (selectedDate < today) {
            setError(date, "La date ne peut pas être dans le passé.");
            isValid = false;
        } else {
            setSuccess(date);
        }

        // Vérifi description
        if (description.value.trim() === "") {
            setError(description, "Veuillez entrer une description (500 caractères max).");
            isValid = false;
        }else if (description.value.length > 500) {
            setError(description, "La description doit contenir moins de 500 caractères.");
            isValid = false;
        } else {
            setSuccess(description);
        }


        if (!isValid) {
            e.preventDefault();
        }
    });
}




// Vérification du formulaire categorie (ADD/EDIT)

const categoryForm = document.getElementById("form-category");

if (categoryForm) {
    categoryForm.addEventListener("submit", function (e) {
        let isValid = true;

        const name = document.getElementById("name");

        // Vérif titre
        if (name.value === "") {
            setError(name, "Veuillez entrer un nom.");
            isValid = false;
        }else if (name.value.length < 4) {
            setError(name, "Le nom doit contenir au moins 4 caractères.");
            isValid = false;
        } else if(name.value.length > 35) {
            setError(name, "Le nom doit contenir moins de 35 caractères.");
            isValid = false;
        } else {
            setSuccess(name);
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
}
