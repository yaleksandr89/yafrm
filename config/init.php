<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

const DEBUG = 'dev'; // 'dev', 'prod'
const LAYOUT = 'ishop';

// >>> PATH CONSTANTS
define('ROOT_PATH', dirname(__DIR__));
const PUBLIC_PATH = ROOT_PATH . '/public';
const APP_PATH = ROOT_PATH . '/app';
const VIEW_PATH = ROOT_PATH . '/app/Views';
const CORE_PATH = ROOT_PATH . '/vendor/core';
const HELPERS_PATH = ROOT_PATH . '/vendor/core/helpers';
const CACHE_PATH = ROOT_PATH . '/tmp/cache';
const LOGS_PATH = ROOT_PATH . '/tmp/logs';
const CONFIG_PATH = ROOT_PATH . '/config';

const PATH_CONSTANTS = [
    'ROOT_PATH' => ROOT_PATH,
    'PUBLIC_PATH' => PUBLIC_PATH,
    'APP_PATH' => APP_PATH,
    'VIEW_PATH' => VIEW_PATH,
    'CORE_PATH' => CORE_PATH,
    'HELPERS_PATH' => HELPERS_PATH,
    'CACHE_PATH' => CACHE_PATH,
    'LOGS_PATH' => LOGS_PATH,
    'CONFIG_PATH' => CONFIG_PATH,
];
// PATH CONSTANTS <<<


// >>> URL CONSTANTS
function getBaseUrl(): string
{
    $scheme = '443' === $_SERVER['SERVER_PORT'] ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];

    return $scheme . $host;
}

define('BASE_URL', getBaseUrl());
const ADMIN_URL = BASE_URL . '/admin';
const NO_IMAGE = BASE_URL . '/upload/no_image.jpg';

const URL_CONSTANTS = [
    'BASE_URL'=> BASE_URL,
    'ADMIN_URL'=> ADMIN_URL,
    'NO_IMAGE'=> NO_IMAGE,
];
// URL CONSTANTS <<<
