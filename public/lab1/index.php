<?php
// 1. Створення базового PHP-скрипта
echo "Hello, World!<br>"; // вивід "Hello, World!"

// 2. Змінні та типи даних
$stringVar = "Рядок"; // рядок
$intVar = 25; // ціле число
$floatVar = 3.14; // число з плаваючою комою
$boolVar = true; // булеве значення

//  вивід значень змінних 
echo $stringVar . "<br>";
echo $intVar . "<br>";
echo $floatVar . "<br>";
echo $boolVar . "<br>";

// вивід типів змінних
var_dump($stringVar);
echo "<br>";
var_dump($intVar);
echo "<br>";
var_dump($floatVar);
echo "<br>";
var_dump($boolVar);
echo "<br><br>";

// 3. Конкатенація рядків
$firstName = "Дмитро"; // записуємо ім'я у змінну
$lastName = "Сиклицький"; // записуємо прізвище у змінну
$fullName = $firstName . " " . $lastName; // об’єднуємо ім'я та прізвище в змінну fullName
echo "Повне ім’я: " . $fullName . "<br><br>"; // вивід fullName


// 4. Умовні конструкції
$number = 7; // число
if ($number % 2 == 0) { // перевірка числа на парність
    echo $number . " є парним<br>"; // якщо True - парне
} else {
    echo $number . " є непарним<br>";// якщо False - непарне
}
echo "<br>";


// 5. Цикли
echo "Цикл for (1 до 10):<br>"; // вивід чисел від 1 до 10 з циклом for
for ($i = 1; $i <= 10; $i++) { 
    echo $i . " ";
}
echo "<br><br>";

echo "Цикл while (10 до 1):<br>"; // вивід чисел від 10 до 1 з циклом while
$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br><br>";


// 6. Масиви
$student = [ // створюємо масив
    "ім'я" => "Дмитро",
    "прізвище" => "Сиклицький",
    "вік" => 20,
    "спеціальність" => "Комп’ютерні науки"
];

// вивід елементів масиву
echo "Інформація про студента:<br>";
echo "Ім’я: " . $student["ім'я"] . "<br>";
echo "Прізвище: " . $student["прізвище"] . "<br>";
echo "Вік: " . $student["вік"] . "<br>";
echo "Спеціальність: " . $student["спеціальність"] . "<br>";

// додаємо середній бал до масиву
$student["середній бал"] = 89.5;

// виводимо оновлений масив
echo "<br>Оновлений масив:<br>";
print_r($student);
echo "<br>";
?>
