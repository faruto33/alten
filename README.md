# ALTEN TEST A REALISER

**Ce projet consiste en a réalisation d'un back end en php / symfony 6.3**

- Création d'une API permettant la gestion de produit : product entity, product repository, product controller
- Utilisation du package doctrine pour une connexion à une BDD postgreSQL
- Utilisation de NelmioApiDoc pour générer la documentation de l'API et pouvoir effectuer des tests swagger

# INSTALLATION ET TEST

- Utilisation de **symfony-docker** et **frankenphp** pour containeurisé le projet
- Pour installer le projet , vous devez utiliser **docker** : télécharger le contenu du projet et lancer la commande **make docker_build** à l'intérieur du répertoire projet pour générer l'image
- Puis **make docker_compose** pour lancer l'execution du container.
- Sur le navigateur ouvrez : https://localhost:4443/api/doc pour avoir accès à la document et aux tests swagger

# API Reference

```http
  https://localhost:4443/products
```

| POST                  | GET                            | PATCH                                    | PUT | DELETE           |
| --------------------- | ------------------------------ | ---------------------------------------- | --- | ---------------- |
| Create a new product  | Retrieve all products          | X                                        | X   |     X            |

```http
  https://localhost:4443/products/{id}
```

| POST                  | GET                            | PATCH                                    | PUT | DELETE           |
| --------------------- | ------------------------------ | ---------------------------------------- | --- | ---------------- |
| X                     | Retrieve details for product id | Update details of product id if it exists | X   | Remove product id |

