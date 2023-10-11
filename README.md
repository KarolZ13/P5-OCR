# P5-OCR

## Presentation du projet

- Blog en php orienté objet.
- Utilisation du modele MVC.
- Page d'accueil.
- Articles.
- Espace d'administration.
- Formulaire de contact.

#### Pour commencer
Cloner le projet sur votre machine.

#### Pré-requis
Ce qu'il est requis pour commencer avec votre projet :
- Serveur local (Xampp, Lamp, wamp...).
- Editeur de texte (Sublime, Vs code, Atom...).

#### Installation
Les étapes pour installer votre programme :

- Démarrer votre serveur local.
- Upload du fichier sql qui est à la racine du projet sur votre interface de géstion de base 
de donnée fournie avec votre serveur local (phpmyadmin...).
- Changement des informations de connexion à la base de donnée : /public/index.php -> ligne 10.
- define('DB_NAME', ''); -> Nom de la base de donnée
- define('DB_HOST', ''); -> Nom d'hôte
- define('DB_USER', ''); -> Utilisateur
- define('DB_PWD', ''); -> Mot de passe


#### Obtenir un compte admin
- Se connecter au SGBD corréspondant à votre serveur local.
- Ouvrir la database "p5_ocr-".
- Aller au niveau de la table "users".
- Modifier les champs "firstname", "lastname", "email", "password", is_admin = 1, is_enable = 1.
- Bien hasher le mot de passe avant d'enregistrer, ici : https://phppasswordhash.com/.

#### Paramétrage du formulaire de contact
Changer les differentes informations concernant l'envoi de mail : /src/controllers/Mail.php

- $mail->isSMTP();
- $mail->Host = Le nom d'hôte de votre serveur de messagerie (ex: smtp.gmail.com)
- $mail->SMTPAuth = true ou false (Selon les informations communiqué par votre serveur de 
messagerie, celle-ci demandera l'authentification SMTP ou non)
- $mail->Username = L'adresse mail
- $mail->Password = Le mot de passe de votre adresse mail
- $mail->SMTPSecure = tls ou ssl (Selon les informations communiqué par votre serveur de messagerie)

#### Démarrage
- Lancer votre serveur local.
- Espace d'administration : (par defaut) -Email : test@test.com ; -Mot de passe : Ceciestuncomptedetest123
