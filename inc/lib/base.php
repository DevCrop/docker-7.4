<?php

//경로 설정
require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/config/path.php";

//DB 설정
require_once LIB_PATH . '/db.php';
$config = require_once CONFIG_PATH . '/db.php';
DB::connect($config);

//헬퍼 설정
require_once CONFIG_PATH . '/helper.php';

// 파일 모듈 설정
require_once MODULE_PATH . '/FileControl.php';
