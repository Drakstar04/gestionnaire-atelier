# AtelierApp - Gestionnaire d'Ateliers Créatifs

## 📄 Présentation du projet

Ce projet est une application web dynamique permettant la gestion et la réservation d'ateliers créatifs (cuisine, bricolage, musique, etc.). 

### Fonctionnalités principales :

* **Visiteurs :**
    * Consulter la liste des ateliers à venir.
    * Rechercher un atelier par nom.
    * Filtrer les ateliers par catégorie.
    * S'inscrire et se connecter.
* **Membres connectés :**
    * Réserver une place pour un atelier (gestion des stocks en temps réel).
    * Consulter l'historique de ses réservations (passées et futures).
    * Annuler une réservation.
* **Administrateur :**
    * Gestion des ateliers (Ajout, Modification, Suppression).
    * Gestion des catégories (Ajout, Modification, Suppression avec sécurité si liée à un atelier).
    * Visualisation de toutes les réservations.

### Technologies utilisées :
* **Back-end :** PHP 8 (POO, MVC), MySQL.
* **Front-end :** HTML5, CSS3, JavaScript (Validation formulaires), Bootstrap 5.
* **Outils :** WAMP Server, phpMyAdmin, Looping (Modélisation MCD).

---

## 🛠 Prérequis techniques

Pour faire tourner le projet en local, vous avez besoin de :

* **Serveur local :** WAMP (recommandé), XAMPP ou MAMP.
* **PHP :** Version 7.4 ou supérieure.
* **Base de données :** MySQL.
* **Navigateur :** Chrome, Firefox ou Edge (récent).

---

## 🚀 Étapes d'installation

Suivez ces étapes pour lancer le projet sur votre machine :

### 1. Récupération des fichiers
Clonez ce dépôt ou décompressez le dossier du projet dans le dossier `www` de WAMP (généralement `C:\wamp64\www\`).

### 2. Base de données
1.  Lancez **WAMP** et ouvrez **phpMyAdmin**.
2.  Créez une nouvelle base de données nommée **`gestionnaire-atelier`**.
3.  Cliquez sur l'onglet **Importer**.
4.  Sélectionnez le fichier **`database.sql`**  situé à la racine du projet.
5.  Exécutez pour créer les tables et insérer les jeux de données.

### 3. Configuration
Vérifiez la connexion à la base de données dans le fichier de configuration (ex: `App/Core/DbConnect.php`).
Par défaut sous WAMP, les identifiants sont souvent :
* **Hôte :** `localhost`
* **Nom BDD :** `gestionnaire-atelier`
* **Utilisateur :** `root`
* **Mot de passe :** *(vide)*

### 4. Lancement
Ouvrez votre navigateur et accédez à l'URL :
`http://localhost/GestionnaireAtelier/public/index.php`

---

## 🔑 Identifiants de test

Voici des comptes pré-créés pour tester les différents rôles :

### Compte Administrateur (Accès complet)
* **Email :** `admin@test.com`
* **Mot de passe :** `1234`

### Compte Utilisateur (Réservation uniquement)
* **Email :** `user@test.com`
* **Mot de passe :** `1234`

---

## 📂 Conception

Le modèle conceptuel de données (MCD) a été réalisé avec le logiciel **Looping**.
Le schéma de la base de données comprend les tables principales : `users`, `workshops`, `categories`, `reservations`, `roles`.