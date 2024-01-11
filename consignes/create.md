# METRO BOULOT DODO
> Appli pour suivre les déplacements **GREEN**

## CRUD : **CREATE**

> !! Pré-requis !!  
Votre **base de donnée** fonctionnelle  
Un **table entreprise** dans laquelle au moins **2 entreprises** seront renseignées 


En respectant le pattern précédent (MVC), il va va falloir mettre en place un formulaire d'inscription.  

- **Controlleur** : controller-signup.php
- **Vue** : view-signup.php

Pour tester, pensez à faire une redirection vers votre controlleur depuis la page **index.php**

---
### ZE Formulaire

Votre formulaire d'inscription devra comporter les champs suivants :

- **Nom** : *Pas de caractère spéciaux, ni de chiffre*
- **Prénom** : *Pas de caractère spéciaux, ni de chiffre*
- **Pseudo** : *Libre à vous de choisir le format*
- **Email** : *Uniquement le format mail*
- **Date de naissance**
- **Mot de passe** : *8 Caractères minimums*
- **Choix de l'entreprise** : *Via un select*
- **Validation des CGU** : *Via une checkbox*

*(La photo et la description seront rajoutées ultèrieurement du fait qu'elles soient facultatives : L'utilisateur complètera son profil ! ;) )*

### Figures imposées 

1. Les champs devront être controlés en amont comme nous l'avions fait précédemment dans *l'exercice du formulaire*. Parmi les classiques des contrôles = 'Pas de champs vide'
2. Création d'un accés à votre base de données autre que ROOT, ex :   
    - **user** : metroboulot
    - **mdp** : green2024
3. Obligation de **l'utilisation de PDO** (https://nouvelle-techno.fr/articles/live-coding-creer-un-crud-en-php) pour les interactions avec la base de données : méfiez-vous des tutos MySQLi !
4. Tous les données devront **être safe** avant d'être enregistrées dans votre **bdd**, notamment à l'aide de **ces fonctions** :
    - htmlspecialchars( ) : https://www.php.net/manual/fr/function.htmlspecialchars.php
    - trim( ) : https://www.php.net/manual/fr/function.trim.php
5. **Pas de stockage de mdp en clair !!!** : Il va falloir utiliser la fonction suivant pour sécuriser le stockage du mdp : 
    - password_hash( ) : https://www.php.net/manual/fr/function.password-hash.php

---

### Enregistrement dans la base de données : YEAH !

Une fois l'utilisateur inscrit dans notre application, il faudra masquer le formulaire et l'inviter à se connecter à l'aide d'un bouton ou url.