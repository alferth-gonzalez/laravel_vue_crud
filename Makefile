up:
\tdocker compose up -d --build

down:
\tdocker compose down

logs:
\tdocker compose logs -f --tail=200

bash:
\tdocker exec -it monolito-app bash

perm:
\tdocker exec -it monolito-app sh -lc "chown -R www-data:www-data storage bootstrap/cache && chmod -R ug+rwX storage bootstrap/cache"

install:
\tdocker exec -it monolito-app composer install
\tdocker exec -it monolito-app php artisan key:generate
\tdocker exec -it monolito-app php artisan migrate

seed:
\tdocker exec -it monolito-app php artisan migrate --seed

build:
\tdocker exec -it monolito-vite sh -lc "npm ci && npm run build"