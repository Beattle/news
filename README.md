1. Скорее всего, здесь потребуется оптимизация как железной так и софтверной части. Необходимо будет выделить отдельные
кластеры  под базу данных и возможно под key value хранилище. Затем профилировать как запросы,через Explain и через дополнительные
enterprise утилиты типа percona toolkit для php можно использовать xhprof для поиска узких мест. 
Выполнить рекомендации google page speed insight https://developers.google.com/speed/pagespeed/insights/?hl=ru&url=https%3A%2F%2Fwww.mk.ru%2F&tab=desktop
2. Дополнительные параметры размера кэш, буффера для тюнинга серверной части https://www.crybit.com/mysql-tweaking-best-practices/
3. Для того чтобы убрать дополнительную нагрузки при нормализации данных в объект доктрины, предлагаю не использовать ORM
а использовать DBAL либо с build query либо с простыми запросами через prepare
4. Поскольку изначально, предполагается большое количество контента необходимо предварительно закэшировать его в статику,
для того чтобы конечный пользователь получатель уже готовую статику, выполнить кэш при запуске модуля. Судя по всем так сейчас и происходит
5. Использовать индексы по Where clause, SORT_BY и т.д.
6. Использовать PK, INNER JOIN вместо OUTER JOIN
7. Не дублировать индексы и т.д. источник https://www.youtube.com/watch?v=9NHrZTIHwKA
8. Не ясно при удалении рубрики должны ли все новости удалятся
9. Структур данных 

 CREATE TABLE `news_post` (
     `id` int UNSIGNED NOT NULL,
     `status` bit(3) NOT NULL, // битовое значения для статуса
     `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
     `publish_date` date NOT NULL
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `post_body`
--

CREATE TABLE `post_body` (
`id` int UNSIGNED NOT NULL,
`text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `post_sections`
--

CREATE TABLE `post_sections` (
`section` int UNSIGNED NOT NULL,
`news_post` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news_post`
--
ALTER TABLE `news_post`
ADD UNIQUE KEY `id` (`id`),
ADD KEY `publish_date` (`publish_date`);
ADD KEY `status` (`status`);

--
-- Индексы таблицы `post_body`
--
ALTER TABLE `post_body`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_sections`
--
ALTER TABLE `post_sections`
ADD KEY `section` (`section`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `news_post`
--
ALTER TABLE `news_post`
MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT; 
