[![Codacy Badge](https://api.codacy.com/project/badge/Grade/990137d81b4c4eedaba33414aab3bb0a)](https://app.codacy.com/gh/Unicen-Tupar/laravel-crud-demo?utm_source=github.com&utm_medium=referral&utm_content=Unicen-Tupar/laravel-crud-demo&utm_campaign=Badge_Grade)
[![codecov](https://codecov.io/gh/unicen-tupar/laravel-crud-demo/branch/master/graph/badge.svg)](https://codecov.io/gh/unicen-tupar/laravel-crud-demo/)
![Static Code Analysis](https://github.com/Unicen-Tupar/laravel-crud-demo/workflows/Static%20Code%20Analysis/badge.svg)
![Laravel](https://github.com/Unicen-Tupar/laravel-crud-demo/workflows/Laravel/badge.svg)
![Dusk Tests](https://github.com/Unicen-Tupar/laravel-crud-demo/workflows/Dusk%20Tests/badge.svg)

# Laravel Task App Example
## Setup
Para hacer andar la app localmente hay ejecutar los siguentes comandos:
Iniciar los containers de docker
```
docker-compose up
```
Crear el .env
```
cp .env.exampe .env
```
Bajar las dependencias
```
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install
```
Correr las migraciones
```
docker-compose run app php artisan migrate --seed
```
Crear el link a storage para que se vean las imagenes adjuntas a las tareas
```
docker-compose run app php artisan storage:link
```

La aplicación esta corriendo en `http://localhost:8080`

Con los seeders se crearon 2 usuarios:
```
User: manager@manager.com
Password: 1234
Role: Manager
```
```
User: test@test.com
Password: 1234
Role: User
```

