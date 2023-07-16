<?php

const DEBUG = 'dev'; // 'dev', 'prod'

define('ROOT_PATH', dirname(__DIR__));

const PUBLIC_PATH = ROOT_PATH . '/public';

const APP_PATH = ROOT_PATH . '/app';

const CORE_PATH = ROOT_PATH . '/vendor/core';

const HELPERS_PATH = ROOT_PATH . '/vendor/core/helpers';

const CACHE_PATH = ROOT_PATH . '/tmp/cache';

const ARRAY_PATH = [
    'root_dir' => ROOT_PATH,
    'public_path' => PUBLIC_PATH,
    'app_path' => APP_PATH,
    'core_path' => CORE_PATH,
    'helpers_path' => HELPERS_PATH,
    'cache_path' => CACHE_PATH,
];
