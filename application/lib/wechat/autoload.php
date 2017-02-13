<?php

spl_autoload_register(function ($class) {
    if (false !== stripos($class, 'Overtrue\Wechat')) {
        require_once __DIR__.'/src/'.str_replace('\\', DIRECTORY_SEPARATOR, substr($class, 8)).'.php';
    }
    if (false !== stripos($class, '_model')) {
        require_once FCPATH.'application/models/'.ucfirst($class).'.php';
    }
    if (false !== stripos($class, 'tool')) {
        require_once FCPATH.'application/'.str_replace('\\', DIRECTORY_SEPARATOR,$class).'.class.php';
    }
});
