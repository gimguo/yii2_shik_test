<p align="center">
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>


docker compose up -d (запустить в корне проекта)
docker inspect psql_container (прописать ip в в common конфиге дб, тут пароли [docker-compose.yml](docker-compose.yml))
docker exec -it frontend_container bash
composer install
init (Dev mode)
php yii migrate
 

можно тестировать по адресу http://127.0.0.1:20080/


common
    config/              прописать бд после инициализации
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets

