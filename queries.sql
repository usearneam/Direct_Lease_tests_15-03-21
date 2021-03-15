-- ЗАДАЧА #2 (SQL ЗАПРОСЫ)
-- Есть несколько таблиц в БД: users, objects
--     1. users: id, login, password, object_id
--     2. objects: id, name, status
-- Нужно сделать выборку пользователей из базы данных с использованием конструкции JOIN у которых есть запись в таблице objects, соответствующая значению object_id


SELECT DISTINCT u.id, u.login, u.password
FROM users u
INNER JOIN objects o
ON u.object_id = o.id;
