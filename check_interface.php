<?php
// debug_autoload.php
require_once __DIR__ . '/vendor/autoload.php';

echo "=== Debug Autoload ===\n\n";

// 1. Проверяем classmap вручную
echo "1. Manual classmap check:\n";
$classMap = require __DIR__ . '/vendor/composer/autoload_classmap.php';
$interfaceName = 'App\Src\Contracts\Interfaces\RouteInterface';

if (isset($classMap[$interfaceName])) {
    echo "✅ Interface FOUND in classmap\n";
    echo "   Path: " . $classMap[$interfaceName] . "\n";
    
    // Проверяем файл
    if (file_exists($classMap[$interfaceName])) {
        echo "✅ File EXISTS\n";
        
        // Пробуем загрузить вручную
        require_once $classMap[$interfaceName];
        echo "✅ Manually required\n";
    } else {
        echo "❌ File NOT FOUND at specified path!\n";
    }
} else {
    echo "❌ Interface NOT in classmap\n";
}

// 2. Проверяем загрузку интерфейса
echo "\n2. Interface loading check:\n";
if (interface_exists($interfaceName)) {
    echo "✅ Interface LOADED\n";
    
    // Проверяем методы
    $methods = get_class_methods($interfaceName);
    echo "   Methods: " . implode(', ', $methods) . "\n";
} else {
    echo "❌ Interface NOT loaded\n";
    
    // Пробуем загрузить через classmap
    if (isset($classMap[$interfaceName]) && file_exists($classMap[$interfaceName])) {
        require_once $classMap[$interfaceName];
        if (interface_exists($interfaceName)) {
            echo "✅ Successfully loaded via classmap\n";
        } else {
            echo "❌ Failed to load even manually\n";
        }
    }
}

// 3. Проверяем Router class
echo "\n3. Router class check:\n";
if (class_exists('App\Core\Router')) {
    echo "✅ Router class loaded\n";
    
    // Проверяем implements
    $implements = class_implements('App\Core\Router');
    if (in_array($interfaceName, $implements)) {
        echo "✅ Router implements RouteInterface\n";
    } else {
        echo "❌ Router does NOT implement RouteInterface\n";
        echo "   Implements: " . implode(', ', $implements) . "\n";
    }
} else {
    echo "❌ Router class not loaded\n";
}