# BASE DE DONNEES


## Besoins base de données

### Utilisateurs
Un utilisateur doit être crée avec un login et un mots de passe propre. 
On doit avoir un moyen de contacter l'utilisateur si celui-ci perd son mots de passe.
Chaque utilisateurs doit pouvoir créer des chasses à son libre besoin.

### Pokémons
Ils faut une base de données avec tous les pokémons. Notons que certains pokémons ont des formes différentes selon des jeux.
Ils doivent être rangés par numéro du Pokedex.
Ils doivent avoir un nom, ainsi que leur générations.
Le sprite des pokémons afficher doit dépendres du jeux séléctionné/laisser libre choix à l'utilisateur.

### Chasses
Les chasses doivent être relié à un utilisateur. 
Leur compteur ne doient pas être < 0.
Il est possible de crée plusieurs chasses du même pokemon. 
Il est possible de crée des chasses sans saisir de pokemons (chasses random : premier qui vient), mais lors de la terminaisons le nom du pokémons doit forcément être données.
Les chasses ont deux statuts : terminer ou non. Une fois terminer on ne peut plus les modifier, juste les supprimer.

### Jeux
Il est important de connaitre les différents jeux.
Ils peuvents avoir plusieurs pokémons. 
Ils peuvent avoir plusieurs méthodes de chasse.