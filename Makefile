run:
	sudo chmod +x docker.dev.sh
	./docker.dev.sh

migration:
	@docker exec -it symfony-api symfony console doctrine:migrations:migrate

createdb:
	@docker exec -it symfony-api symfony console doctrine:database:create

apidoc:
	@docker exec -it symfony-api symfony console nelmio:apidoc:dump
