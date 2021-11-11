# subir imagem
docker-compose -p symfony -f docker-compose.dev.yml config
docker-compose -p symfony -f docker-compose.dev.yml pull
docker-compose -p symfony -f docker-compose.dev.yml rm -f -s -v
docker-compose -p symfony -f docker-compose.dev.yml up -d --build


