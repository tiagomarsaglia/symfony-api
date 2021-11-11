# SYMFONY API

Esse é um exemplo de uma api em symfony

## Installation

Antes de iniciar o projeto cheque as portas utilizadas para não haver conflito

Portas usadas
  - 9000 - php-app
  - 9001 - xdebug
  - 80/443 - nginx
  - 3306 - mysql_db
  - 9002 - sonar

execute os comandos abaixos para rodar a aplicação

```bash
make run
```

## Usage

- você pode usar o insomnia ou o postman para testar a aplicação
- a documentação da aplicação pode ser encontrada em http://localhost/doc.json
- você pode verificar os dados de cobertura do sonar também na rota http://localhost:9002

```bash

# cria o banco da aplicação
make createdb

# roda os arquivos de migração de banco
make migration

# gera os arquivos de documentação
make apidoc

# executa os testes da aplicação
make test

# gerar os arquivos de cobertura da aplicação
make coverage

# executa o sonar-scanner
make sonar


```



## License
[MIT](https://choosealicense.com/licenses/mit/)