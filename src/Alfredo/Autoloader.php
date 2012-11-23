<?php

spl_autoload_register(function($className) {
            $filename = __DIR__ . '/' . str_replace(array('\\', 'Alfredo/'), array('/', ''), ltrim($className, '\\')) . '.php';
            if (file_exists($filename)) {
                require_once $filename;
            }
        });