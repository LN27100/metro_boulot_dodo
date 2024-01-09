# Mise en place de la Base de donnée
> Métro Boulot Dodo

Nous allons mettre en place un suivi de trajets pour un challenge écolo : Les utilisateurs vont devoir enregistrer tous leurs **déplacements verts** pour venir au boulot : "marche, vélo, trottinette, roller ... " et **même parfois en dehors du boulot pour les plus sportifs**

---

Pour participer, l'utilisateur devra s'inscrire :  *obligatoire
- Nom*
- Prénom*
- Pseudo*
- Date de naissance*
- Email*
- Mot de passe*
- Une photo / image (facultative)
- Une description (facultative)

Lors de l'inscription, l'utilisateur devra sélectionner le nom de l'entreprise pour laquelle il va cumuler des Kms pour le / les challenges.

---

Une entreprise aura pour informations : *obligatoire
- Un nom*
- Un Email*
- Un mot de passe*
- Un numéro SIRET*
- Une adresse* : Ex. Avenue Robespierre.
- Un code postal*
- Une ville*
- Une photo / image (facultative)

Les entreprises pourront modérer leurs utilisateurs : **ex. Suspendre une publication de trajet en raison de non respect à la charte, idem pour un utilisateur qui seraient soupçonné de tricherie.**

---

L'entreprise pourra mettre en place des events ou "spécial challenge" : Ex. le mois du vélo, tous en mode TonyHawk ...  
Elle pourra donc créer des évènements qui auront comme informations : *obligatoire  
- La date de début*
- La date de fin*
- Le nom de challenge*
- Description du challenge*
- Le ou les modes de transport pris en compte*
- Une photo / image (facultative)

---

Une fois inscrits et validés, les utilisateurs pourront enregistrer leurs trajets qui comporteront les infos suivantes : *obligatoire  
- La date du trajet*
- La distance parcourue* : ex. 0.15 km ..
- Le temps du trajet* : ex. 15mins, 60mins ...
- Le type* : Vélo, Trottinette, Marche ...
- Une photo / le parcours du trajet (facultative)

---

Parmi les modes de transports écolos le challenge n'en prends en compte que 5  :
- Le vélo
- La trottinette
- La marche
- Le roller
- Le skate

---

Pour gérer l'application nous allons mettre en place des admins qui pourront se logger à l'aide d'un mot de passe et d'un Email.  
Leur rôle sera de valider l'enregistrement des entreprises après la vérification du numéro SIRET.  
Il pourront également modérer le site et gérer toute demande technique liée aux challenges :)