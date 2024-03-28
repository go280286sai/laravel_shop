# Поиск с помощюь Json

После установки пакета нам надо выполнить миграцию и добавить таблицу для индексации:

    php artisan migrate

    php artisan search:add

Таблицу добавляем по названию модели, например:

    post

После чего надо добавить в модель trait:

    use JsonModel;

Также можно указать поля которые будут индексироваться в таблице, по умолчанию будут выбираться все поля:

    private static array $select_fields = ['title', 'description'];

После этого выполним:

    php artisan search:run

Маршрут для поска "/search" через POST запрос
или Index_search::search_text($text) для создания своего контроллера.

Дополнительно:

Удаляет только определенную таблицу с индексации

    php artisan search:remove

Удаляет все данные таблиц, файлы и логи

    php artisan:clear
