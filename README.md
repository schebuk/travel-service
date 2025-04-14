Microsserviço para gerenciamento de pedidos de viagem corporativa.

## Requisitos

- Docker
- Docker Compose
- Laravel 11
- MySQL

## Instalação

```bash
git clone https://github.com/schebuk/travel-request-service.git
cd travel-request-service
cp .env.example .env
Configure as variáveis de ambiente no .env.
```

## Subir com Docker
```bash
Copiar
Editar
docker-compose up -d --build
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan jwt:secret
```

## Autenticação
Use o endpoint POST /api/login com email e password para receber o token.

Envie o token no header Authorization: Bearer <token> nas próximas requisições.
## Endpoints
GET /api/requests: Lista pedidos do usuário autenticado

POST /api/requests: Cria novo pedido

GET /api/requests/{id}: Visualiza um pedido

PATCH /api/requests/{id}/status: Atualiza status (aprovado ou cancelado)

## Testes
```bash
Copiar
Editar
docker-compose exec app php artisan test
```