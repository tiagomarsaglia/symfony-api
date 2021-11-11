run:
	sudo chmod +x docker.dev.sh
	./docker.dev.sh

migration:
	@docker exec -it symfony-api symfony console doctrine:migrations:migrate
	@docker exec -it symfony-api symfony console --env=test doctrine:migrations:migrate

createdb:
	@docker exec -it symfony-api symfony console doctrine:database:create
	@docker exec -it symfony-api symfony console --env=test doctrine:database:create

apidoc:
	@docker exec -it symfony-api symfony console nelmio:apidoc:dump

test:
	@docker exec -it symfony-api composer test

coverage:
	@docker exec -it symfony-api composer test-coverage

sonar:
	@docker exec -it symfony-api composer sonar