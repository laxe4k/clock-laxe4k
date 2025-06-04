# Laxe4k - Clock

![Licence](https://img.shields.io/github/license/laxe4k/clock.laxe4k.com)

## Description

**Laxe4k - Clock** est un site web qui vous permet de voir l'heure en temps réel en fonction de votre fuseau horaire. Il propose également un compte à rebours configurable pour ne rien manquer de vos évènements.

## Fonctionnalités

- Affichage de l'heure en temps réel selon le fuseau horaire sélectionné.
- Changement de fuseau horaire via un menu déroulant.
- Affichage en plein écran en cliquant sur l'heure.
- Compte à rebours configurable grâce à un simple formulaire.

## Utilisation

- **Choix du fuseau horaire :** sélectionnez votre zone dans le menu déroulant situé en haut de la page.
- **Plein écran :** cliquez sur l'heure pour afficher l'horloge sans l'en-tête ni le pied de page.
- **Compte à rebours :** indiquez le nombre de minutes souhaité puis lancez le minuteur.

## Technologies utilisées

- ![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
- ![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
- ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
- ![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)

## Prérequis

- Un serveur web compatible PHP (par exemple, Apache)
- PHP version 7.4 ou supérieure

## Installation

1. **Cloner le dépôt :**

    ```sh
    git clone https://github.com/laxe4k/clock.laxe4k.com.git
    ```

2. **Accéder au répertoire du projet :**

    ```sh
    cd clock.laxe4k.com
    ```

3. **Configurer le serveur web :**

   - Pour Apache : Assurez-vous que le module `mod_php` est activé et que le répertoire du projet est accessible via un hôte virtuel ou le répertoire `htdocs`.

4. **Vérifier les permissions :**

   Assurez-vous que le serveur web a les permissions nécessaires pour lire les fichiers du projet.

## Déploiement

Le déploiement est automatisé grâce à GitHub Actions. À chaque push sur la branche principale, le workflow défini dans `.github/workflows/main.yml` est déclenché pour synchroniser les fichiers avec le serveur via FTP.

Pour configurer le déploiement automatique :

1. **Configurer les secrets GitHub :**

   - Accédez aux paramètres du dépôt sur GitHub.
   - Dans la section "Secrets and variables" > "Actions", ajoutez les secrets suivants :
     - `FTP_HOST` : l'adresse du serveur FTP
     - `FTP_USERNAME` : votre nom d'utilisateur FTP
     - `FTP_PASSWORD` : votre mot de passe FTP

2. **Personnaliser le workflow :**

   Si nécessaire, modifiez le fichier `.github/workflows/main.yml` pour adapter le processus de déploiement à vos besoins spécifiques.

## Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. **Forkez** le dépôt.
2. **Créez** une branche pour votre fonctionnalité ou correction de bug (`git checkout -b feature/ma-fonctionnalite`).
3. **Commitez** vos modifications (`git commit -m 'Ajout de ma fonctionnalité'`).
4. **Poussez** vers la branche (`git push origin feature/ma-fonctionnalite`).
5. **Ouvrez** une pull request.

Veuillez vous assurer que votre code respecte les normes de style du projet et qu'il est bien documenté.

## Licence

Ce projet est sous licence MIT. Veuillez consulter le fichier `LICENSE` pour plus de détails.

## Auteur

Développé par [Laxe4k](https://github.com/laxe4k).
