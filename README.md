- Baixar o projeto
https://github.com/helton-fernandes/apiteste.git

- Renomear o arquivo .env.exemple para .env

- ajustar as configurações do banco de dados conforme seu banco

- rodar o composer install para resolver as dependencias

- rodar as migrations
    php artisan migrate

- rodar as seeders
    php artisan db:seed

- subir a aplicação
    php artisan serve

- importar o arquivo Insomnia_API no Insomnia para testar os endpoints


Para obter o token de autenticação dos endpoints utilizar o end point Login com as informações abaixo:
no corpo da requisição JSON

{
    "email": "teste@teste.com",
	"password": "123456"
}

Login - Utilizado para obter o token de autenticação (Bearer Token)  que será utilizado no corpo das outras requisções
POST - http://localhost:8000/api/login



Logout - Utilizado para deslogar o usuario (parametros: token, id do usuario)
POST - http://localhost:8000/api/logout/{user}

Listar Usuarios (parametros: token, id do usuario)
GET - http://localhost:8000/api/users

Inserir Usuario  (parametros: token)
POST - http://localhost:8000/api/users

Visualizar Usuario (parametros: token, id do usuario)
GET - http://localhost:8000/api/users/{user}

Atualizar Usuario (parametros: token, id do usuario)
PUT - http://localhost:8000/api/users/{user}

Deletar Usuário (parametros: token, id do usuario)
DELETE - http://localhost:8000/api/users/{id}
