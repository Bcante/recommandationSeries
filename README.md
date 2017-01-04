# Installation

Voici toutes les étapes pour l'installation du projet.

### Etape 1 : 

Importer la base de données à l'aide du script `bdd.sql` dans PHPMyAdmin.

### Etape 2 : 

Installer les dépendances avec l'outil "composer" en lançant la commande `composer install` depuis la racine du projet.

### Etape 3 : 

Création d’un fichier `db.ini` dans `/src/conf/`.

Ce fichier doit contenir ces lignes (et les parties droites doivent naturellement être complétées avec vos informations).

`driver=mysql
host=127.0.0.1
database=recommandationSeries
username=****
password=****
charset=utf8
collation=utf8_unicode_ci
prefix=`

NB : `prefix` peut rester vide

# Utilisation

Rendez-vous sur l'adresse 127.0.0.1 pour accéder à TVSeries en localhost.