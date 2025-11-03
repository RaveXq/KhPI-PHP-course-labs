<?php
// Серверне кешування через статичну властивість класу

// Клас для кешування новин на час одного запиту
class NewsCache {
    private static $cache = null;
    public static $source = "Не визначено";

    // Отримує новини (з кешу або генерує нові)
    public static function getNews() {
        if (self::$cache === null) {
            // Кеш порожній, генеруємо дані
            self::$cache = self::generateNews();
            self::$source = "Згенеровано щойно (2 сек)";
        } else {
            // Беремо з кешу
            self::$source = "Зі статичного кешу (миттєво)";
        }
        return self::$cache;
    }

    // Генерація новин
    private static function generateNews() {
        sleep(2); // Затримка 2 секунди
        return [
            'Новина 1',
            'Новина 2',
            'Новина 3'
        ];
    }
}

// Ми викликаємо функцію двічі
// Перший виклик (з затримкою)
$news1 = NewsCache::getNews();
$source1 = NewsCache::$source;
$list1 = "<ul>";
foreach ($news1 as $item) { $list1 .= "<li>".htmlspecialchars($item)."</li>"; }
$list1 .= "</ul>";

// Другий виклик (миттєвий)
$news2 = NewsCache::getNews();
$source2 = NewsCache::$source;
$list2 = "<ul>";
foreach ($news2 as $item) { $list2 .= "<li>".htmlspecialchars($item)." (копія)</li>"; }
$list2 .= "</ul>";

// Вивід результату
?>
<div style="font-family: sans-serif; padding: 10px;">
    <strong>Перший виклик функції:</strong>
    <?php echo $list1; ?>
    <small>Джерело: <?php echo htmlspecialchars($source1); ?></small>
    <hr>
    <strong>Другий виклик функції (в цьому ж запиті):</strong>
    <?php echo $list2; ?>
    <small>Джерело: <?php echo htmlspecialchars($source2); ?></small>
</div>
