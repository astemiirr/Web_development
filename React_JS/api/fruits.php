<?php
// Разрешить CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Обработка preflight запроса
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// API для фруктов с пагинацией
$fruits = [
    ['id' => 1, 'name' => 'Яблоки', 'price' => 120, 'releaseDate' => '2024-03-15', 'description' => 'Свежие сладкие яблоки', 'image' => 'fruit1.png', 'category' => 'Фрукты'],
    ['id' => 2, 'name' => 'Бананы', 'price' => 85, 'releaseDate' => '2024-03-12', 'description' => 'Спелые бананы', 'image' => 'fruit2.png', 'category' => 'Фрукты'],
    ['id' => 3, 'name' => 'Апельсины', 'price' => 110, 'releaseDate' => '2024-03-10', 'description' => 'Сочные апельсины', 'image' => 'fruit3.png', 'category' => 'Цитрусовые'],
    ['id' => 4, 'name' => 'Клубника', 'price' => 250, 'releaseDate' => '2024-03-05', 'description' => 'Свежая клубника', 'image' => 'fruit4.png', 'category' => 'Ягоды'],
    ['id' => 5, 'name' => 'Виноград', 'price' => 180, 'releaseDate' => '2024-03-08', 'description' => 'Сладкий виноград', 'image' => 'fruit5.png', 'category' => 'Ягоды'],
    ['id' => 6, 'name' => 'Манго', 'price' => 190, 'releaseDate' => '2024-03-01', 'description' => 'Спелое манго', 'image' => 'fruit6.png', 'category' => 'Экзотические'],
    ['id' => 7, 'name' => 'Ананас', 'price' => 300, 'releaseDate' => '2024-02-28', 'description' => 'Свежий ананас', 'image' => 'fruit7.png', 'category' => 'Экзотические'],
    ['id' => 8, 'name' => 'Киви', 'price' => 140, 'releaseDate' => '2024-03-03', 'description' => 'Зеленый киви', 'image' => 'fruit8.png', 'category' => 'Экзотические'],
    ['id' => 9, 'name' => 'Груши', 'price' => 95, 'releaseDate' => '2024-03-07', 'description' => 'Сочные груши', 'image' => 'fruit9.png', 'category' => 'Фрукты'],
    ['id' => 10, 'name' => 'Персики', 'price' => 160, 'releaseDate' => '2024-03-02', 'description' => 'Ароматные персики', 'image' => 'fruit10.png', 'category' => 'Фрукты'],
    ['id' => 11, 'name' => 'Арбуз', 'price' => 45, 'releaseDate' => '2024-02-25', 'description' => 'Сладкий арбуз', 'image' => 'fruit11.png', 'category' => 'Бахчевые'],
    ['id' => 12, 'name' => 'Дыня', 'price' => 70, 'releaseDate' => '2024-02-27', 'description' => 'Ароматная дыня', 'image' => 'fruit12.png', 'category' => 'Бахчевые'],
    ['id' => 13, 'name' => 'Лимон', 'price' => 60, 'releaseDate' => '2024-03-14', 'description' => 'Свежий лимон', 'image' => 'fruit13.png', 'category' => 'Цитрусовые'],
    ['id' => 14, 'name' => 'Гранат', 'price' => 220, 'releaseDate' => '2024-03-06', 'description' => 'Спелый гранат', 'image' => 'fruit14.png', 'category' => 'Экзотические'],
    ['id' => 15, 'name' => 'Авокадо', 'price' => 150, 'releaseDate' => '2024-03-09', 'description' => 'Созревший авокадо', 'image' => 'fruit15.png', 'category' => 'Овощи']
];

// Пагинация
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

$offset = ($page - 1) * $limit;
$result = array_slice($fruits, $offset, $limit);

header('Content-Type: application/json');
echo json_encode([
    'products' => $result,
    'total' => count($fruits),
    'page' => $page,
    'limit' => $limit,
    'hasMore' => ($offset + $limit) < count($fruits)
]);
