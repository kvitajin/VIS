<?php

// Databázové cesty
define('DB_PATH', __DIR__ . '/../db/db.sqlite3');
define('DB_IMG_PATH', __DIR__ . '/../static/db/img');
define('DB_TXT_PATH', __DIR__ . '/../static/db/txt');

// Oprávnění
define('PERMISSION_CREATE_COMMENT', 1);
define('PERMISSION_CREATE_PASTORACNI', 2);
define('PERMISSION_CREATE_EKONOMICKA', 4);
define('PERMISSION_CREATE_ARTICLE', 8);
define('PERMISSION_CREATE_ABOUT', 16);

define('PERMISSION_REMOVE_COMMENT', 32);
define('PERMISSION_REMOVE_PASTORACNI', 64);
define('PERMISSION_REMOVE_EKONOMICKA', 128);
define('PERMISSION_REMOVE_ARTICLE', 256);
define('PERMISSION_REMOVE_ABOUT', 512);

define('PERMISSION_SHADOW_BAN_USER', 1024);
