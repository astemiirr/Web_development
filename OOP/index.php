<?php
// Автозагрузка
spl_autoload_register(function ($class) {
    // Zoo\Models\Lion → src/Models/Lion.php
    $class = str_replace('Zoo\\', '', $class);
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    } else {
        echo "File not found: $file\n";
    }
});

use Zoo\Models\Lion;
use Zoo\Models\Eagle;
use Zoo\Models\Animal;

echo "=== ДЕМО ООП ПРОЕКТ 'ЗООПАРК' ===\n\n";

// 1. СОЗДАНИЕ ОБЪЕКТОВ
echo "1. СОЗДАНИЕ ОБЪЕКТОВ:\n";
$lion = new Lion('Simba', 5, 25.5);
$eagle = new Eagle('Thunder', 8, 2.2);

// 2. МАГИЧЕСКИЕ МЕТОДЫ
echo "\n2. МАГИЧЕСКИЕ МЕТОДЫ:\n";
echo "Строковое представление: $lion\n";
echo 'Отладочная информация: ';
print_r($lion->__debugInfo());

// 3. НАСЛЕДОВАНИЕ/ПОЛИМОРФИЗМ
echo "\n3. НАСЛЕДОВАНИЕ И ПОЛИМОРФИЗМ:\n";
echo "Lion: " . $lion->makeSound() . "\n";
echo "Eagle: " . $eagle->makeSound() . "\n";
echo $lion->hunt() . "\n";
echo $eagle->fly() . "\n";

// 4. КЛОНИРОВАНИЕ
echo "\n4. КЛОНИРОВАНИЕ:\n";
$lionClone = clone $lion;
echo "Оригинал: {$lion->getId()}\n";
echo "Клон: {$lionClone->getId()}\n";

// 5. СЕРИАЛИЗАЦИЯ (ТОЛЬКО JSON)
echo "\n5. JSON-СЕРИАЛИЗАЦИЯ:\n";
echo $lion->toJson() . "\n";

// 6. АНОНИМНЫЙ КЛАСС
echo "\n6. АНОНИМНЫЙ КЛАСС:\n";
$validator = new class {
    public function validate(array $data): bool
    {
        return isset($data['name'], $data['age']);
    }
    
    public function generateAnimal(): array
    {
        return ['name' => 'Тестовое', 'age' => 3];
    }
};
echo 'Валидация: ' . ($validator->validate(['name' => 'Тест', 'age' => 5]) ? 'OK' : 'FAIL') . "\n";

// 7. FINAL МЕТОД
echo "\n7. FINAL МЕТОД:\n";
echo 'Сила рыка: ' . $lion->getRoarPower() . "\n";

// 8. ДЕСТРУКТОРЫ И СТАТИКА
echo "\n8. СТАТИЧЕСКИЕ МЕТОДЫ:\n";
echo 'Всего животных: ' . Animal::getTotalAnimals() . "\n";

// 9. ИНФОРМАЦИЯ
echo "\n9. ИНФОРМАЦИЯ О ЖИВОТНЫХ:\n";
print_r($lion->getInfo());
print_r($eagle->getInfo());