Projet dev: Piloco

## Fonctionnement

Le principe du jeu est de faire ou répondre à une question ou une action proposé par le jeu. L'echec entrainera des gorgés.


- Faire apparaître les questions en mode aléatoires sans les répéter

- Définir un ordre aléatoire de joueur

- Tire au hasard des questions dans la bdd

- A tour de rôle les utilisateurs ont une question

- Les utilisateurs ont le choix de repondre entre oui et non

- Une fois la réponse de l'utilisateur on passe au joueur suivant

- Parfois advient un malus aléatoire

- Faire player, et admin

## Contenu CRUD BDD

// Difficulté: 3
L'Api est en Laravel, elle permet à un utlisateur de:

- créer un utilisateur
- modifier un utilisateur
- se connecter 
- déconnecter
- créer une partie


Le super Admin peut:

- CRUD des modes de jeu
- CRUD des questions

- Permettre aux joueurs de créer leurs questions
La question est envoyé aux modérateurs, si la question est validé elle sera ajouté à la base de donnée sinon elle sera refusé.
Un mail sera envoyé à l'utilisateur pour lui informé de l'état d'avancement de sa question.

### Utilisateur

- nom d'utilisateur
- date de naissance (majeur)
- email
- mot de passe

## Questions
- Mode
- Text
- Gorgée

Questions possibles :

- 1 minute de sourire non stop pour Benjam 3 pénalités à chaque manque.
- Plus de téléphone ! La première personne à consulter son smartphone prend 10 pénalités
- **JEU** A tour de rôle : vous avez 1 seconde pour dire un mot qui à la suite du précédent, peut conclure sur une phrase sensée. Le ou la perdante prend 3 pénalités, Benjam Commence !
- **VIRUS** Pour tout le monde : commencez toutes vos phrases par "euuuhhhhh", que ça dure au moins 3 secondes. 4 pénalités à chaque manque.
- **PENALITE ULTIME** Pour ceux qui vont en boîte après, on se motive... Pénalité ultimeeeeeee ...

### Mode de jeu
Pour les admins :
- name
- description

Plusieurs modes avec un dégré de question différent:
- Découverte : Pour ceux qui souhaitent commencer la soirée en beauté.
- Avancé : Pour ceux ou la soirée est déjà dans un stage avancé !
- Ivrogne (9,99€) : Uniquement pour la team Piloco, de vrai Ivrogne ceux la.

## Difficulté technique

- Le jeu sera jouable depuis plusieurs postes connectés entre eux. (web socket, serveur)

- Faire un chat

Add
- Faire vocal

- Faire visio

With add: 52
Without add 34 + 6 BDD ORM: 40


## Installation pour les devs :
(Installer PHP et Composer au préalable)

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate:fresh --seed
yarn install

## Lauch server
php artisan serve --host=localhost

## Lauch front-end
yarn run hot

## Start socket
php artisan websockets:serve
