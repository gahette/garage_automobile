

# ===================== #
# Mise à jour du projet #
# ===================== #
update: ## Met à jour le projet avec les informations de composer.lock (ne les met pas à jour)
	composer install

upgrade: ## Met à jour le projet avec les informations de composer.json (met à jour le composer.lock)
	composer update

# ================================== #
# Manipulation de la base de données #
# ================================== #
entity: ## Crée ou modifie une entité
	php bin/console make:entity

migration: ## Génère une migration avec les changements des entités
	php bin/console make:migration

migrate: ## Exécute les migrations
	php bin/console doctrine:migrations:migrate

migrations.list: ## Liste des migrations
	php bin/console doctrine:migrations:list

db.recreate: ## Commande (d'urgence) pour recreer la BdD depuis 0 
	db.drop db.create migrate fixtures

db.drop:
	php bin/console doctrine:database:drop -f

db.create:
	php bin/console doctrine:database:create

fixtures:
	php bin/console doctrine:fixtures:load

admin.crud:
	php bin/console make:admin:crud

# ============= #
# Vérifications #
# ============= #
check: ## Vérification de la qualité et de la cohérence du code
	composer check
	php bin/console lint:yaml config
	php bin/console lint:twig templates

csfix: ## Correction (automatique) de la qualité du code
	composer fix

# ============= #
# Documentation #
# ============= #
help:
	@grep -E '^[a-zA-Z_-]+:.*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-9s\033[0m %s\n", $$1, $$2}'


