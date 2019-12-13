<?php


if (preg_match('/\.(?:png|jpg|jpeg|gif|css|svg)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
} else {
    require __DIR__ . '/src/spojova/index.php';
}
