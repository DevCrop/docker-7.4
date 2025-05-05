<?php

// 기본 경로
define('BASE_PATH', rtrim($_SERVER['DOCUMENT_ROOT'], '/')); // /var/www/html


// 서브 폴더 경로 (물리적 경로)
define('INC_PATH', BASE_PATH . '/inc');
define('LIB_PATH', BASE_PATH . '/inc/lib');
define('CONFIG_PATH', BASE_PATH . '/inc/config');
define('MODULE_PATH', BASE_PATH . '/inc/module');
define('LAYOUTS_PATH', BASE_PATH . '/inc/layouts');
define('RESOURCE_PATH', BASE_PATH . '/resource');
define('UPLOAD_PATH', BASE_PATH . '/uploads');
