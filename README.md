# Plateforme de Gestion d'Absences

## Présentation

Cette application est une plateforme de gestion d'absences conçue pour simplifier le suivi des absences des employés dans une organisation.

## Installation

1. Clonez le dépôt :
```
git clone https://github.com/leogrd49/Laravel.git
```

2. Naviguez dans le dossier du projet :
```
cd Laravel
```

3. Installez les dépendances :
Pour composer si vous ne l'avez pas déjà, rendez-vous sur ce site: https://getcomposer.org/download/
et pour NodeJS rendez-vous sur ce site: https://nodejs.org/en/download/package-manager

```
composer install
npm install
```

4. Copiez le fichier `.env.example` en `.env` et configurez vos variables d'environnement, notamment la connexion à la base de données.

5. Générez la clé d'application :
```
php artisan key:generate
```

6. Exécutez les migrations et les seeders :
```
php artisan migrate --seed
```

7. Compilez les assets :
```
npm run dev
```

## Auteur

Léo GERARD
