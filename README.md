# Ressources Relationnelles API

(RE)Sources Relationnelles est un un projet porté par le Ministère des Solidarités et de la Santé à destination des citoyens afin de proposer une plateforme de sources, ressources, et d’échanges.
Le principal enjeu du projet (RE)Sources Relationnelles est de proposer des ressources et outils pour créer, renforcer et enrichir les relations des citoyens.

L'API fonctionne de pair avec l'application utilisant l'API pour fonctionner. Son code source ainsi que sa documentation est disponible depuis le lien suivant : https://github.com/Pepytau/Ressources-Relationnelles-Ionic

# Techologies Utilisées : 

L'API est hébergée sur un ![image](https://user-images.githubusercontent.com/68700452/233181282-557afc3e-1314-41ed-af59-9867662f04ee.png) Raspberry PI 4 4Go ![image](https://user-images.githubusercontent.com/68700452/233181282-557afc3e-1314-41ed-af59-9867662f04ee.png), sous Debian 11.

Celle-ci tourne sur un serveur web Apache 2.4 et sous PHP 7.4


![apache-logo](https://user-images.githubusercontent.com/68700452/233182162-1b95b516-91a0-45a6-88f3-3245f794229c.png)![5968332](https://user-images.githubusercontent.com/68700452/233182166-46db95c5-be98-41eb-b24b-b1e1017404d9.png)


# Arborescence de l'API : 

![image](https://user-images.githubusercontent.com/68700452/233182870-15cb45c4-22f8-407b-92c9-0d476b12affd.png)


assets : Les différentes ressources de l'application (Images...)

classes : Les différentes classes utilisées par l'API.

configs : Les différents fichiers de config (routes...).

controllers : Les controlleurs de chaque classes (Utilisateurs, Ressources...).

data : Emplacement de stockage des ressources.

exceptions : Erreurs personalisées de l'API.

managers : Connecteurs entre la base de donnée et l'API.

.htaccess : Fichier de configuration pour le serveur web.

autoload.php : Script permettant de charger tous les fichiers nécessaire pour le bon fonctionnement de l'API.

index.php : 'Endpoint' de l'application, là ou les requêtes vous arrivées pour être traitées.

# Fonctionnement de l'API :

Lorsqu'une requête est envoyée au serveur, celui-ci va d'abord vérifier si elle existe bien dans le fichier des routes.

Si oui, le serveur va utiliser le controlleur et le manager correspondant à la route afin de réaliser les actions demandées.

Si non, le serveur va renvoyer une erreur à l'application.

# Définition d'une route : 

![image](https://user-images.githubusercontent.com/68700452/233184904-c37a2d34-f182-445b-bd3a-9be06067dd33.png)

Une route est composée de 6 paramètres: 

path : L'emplacement de la requête.

action : La fonction à effectuer après la requête.

controller : Le controlleur à utiliser pour le chemin.

method : La méthode utilisée (GET, POST, PUT, DELETE).

param : Les paramètres néscéssaires à la requête.

manager : Le manager à utilisé pour la requête.

# Réponse de l'API :

L'API va envoyer une réponses à l'application sous la forme d'une chaine de charactère formatter en JSON.

![image](https://user-images.githubusercontent.com/68700452/233185873-3ef082da-b631-4e97-a94d-7f8a9fc13ec6.png)


