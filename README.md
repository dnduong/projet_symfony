Conception et implémentation d'un site utilisant le framework Symfony et SQL.

I- Principe du site:
Il s’agit d’une plateforme en ligne de réservation de places de restaurants. 
Les utilisateurs peuvent faire une réservation dans l’un des restaurants disponibles en fonctions des horaires disponibles.
Les restaurants peuvent spécifier leurs disponibilités et mettre en ligne des informations pouvant être utiles aux clients désirant faire des réservations.
Ainsi, l’utilisation de notre site commence par la création d’un compte unique à chacun et personnalisable, avec une photo de profil.
Chaque restaurateur détenteur de compte peut donc poster des images de son restaurant, préciser son adresse et ses informations utiles.
Chaque client détenteur de compte peut quant à lui prendre une réservation, chercher les restaurants et les horaires disponibles, ainsi que consulter ses réservations.
Les clients utilisateurs auront également la possibilité de retrouver des restaurants grâce à la barre de recherche dont dispose notre site. Ils peuvent également retrouver tous les restaurants précédemment recherchés.

II- Choix techniques :
Pour ce faire, nous avons séparé notre travail en trois parties principales respectant le modèle Modèle-Vue-Contrôleur. 

La partie Modèle contient le traitement logique de nos données tel que les accès à la base de données, étant gérée par php Mysql. Les fichiers concernés sont contenus dans le sous-répertoire config du répertoire app.

La partie Vue concerne le côté esthétique de notre site et se compose des 
Templates (fichiers html.twig) contenus dans le sous-répertoire views.

La partie Contrôleur comporte toutes les fonctions nécessaires au fonctionnement de notre site, notamment les pages d’inscription, de connexion et de gestion du profil utilisateur.

IV- Contenu des fichiers :

Un répertoire app contenant :
Le sous-répertoire config contenant  les fichiers de configuration du Modèle évoqué dans la partie II de ce rapport.
Le sous-répertoire Resources contenant le sous-répertoire views de la partie Vue, ainsi que le dossier security contenant la page de connexion sécurisée.
Un répertoire src contenant le répertoire AppBundle qui contient :
Le sous-répertoire Controller qui s’occupe de gérer la partie Contrôleur du modèle MVC de notre site, évoquée dans la partie II.
Le sous-répertoire Entity contenant les classes que nous avons créées.
Quelques autres sous-répertoires contenant également des classes créées pour notre site.
Un répertoire web contenant toutes les données publiques telles que notamment les images téléchargées sur notre site par les utilisateurs et qui peuvent donc être visibles par tous les autres utilisateurs.
