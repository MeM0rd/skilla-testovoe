## Как развернуть:
1) Склонировать репозиторий
2) Выполнить команды в корне проекта
```
cp .env.example .env
docker-compose up -d
```
3) Зайти внутрь контейнер testovoe-app
4) Прописать команды
```
composer i
php artisan migrate --seed
php artisan key:generate
```

### Доступные роуты http://localhost/api:
1) POST /register - регистрация
2) POST /login - аутентификация в приложении

### Необходимо зарегистрировать пользователя, тк остальные роуты под мидлваром. Логин возвращает token, который нужен для аутентификации (Bearer)

### остальные роуты:
1) /logout - сброс сесссии

#### префикс /sessions
1) GET /{user_id} — Просмотр активных сессий пользователя
2) DELETE / — Удаление конкретной сессии

#### префикс /order
1) POST / — Создание заказа
2) POST /assign-worker — Добавление исполнителя к заказу

#### префикс /worker
1) POST /filter-type — Филтр исполнителей по типам заказов, от которых они отказались
