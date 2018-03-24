<?php

function getImages($path) {
    $path = realpath($path);
    $allFilesInDir = $path . '\\*';
    echo "Список изображений в директории <strong>" . $path . "</strong>, размер которых больше 5Мб.<br><br>";
    $imagePaths = (glob($allFilesInDir . '.{jpg,gif,png}', GLOB_BRACE));
    $assocArray = [];

    foreach ($imagePaths as $imagePath) {
        if (filesize($imagePath) > 5242880) {
            $assocArray[$imagePath] = filesize($imagePath);
        }
    }

    foreach ($assocArray as $imgPath => $size) {
        echo "Изображение " . basename($imgPath) . ", размер " . $size . " байт.<br>";
    }
}