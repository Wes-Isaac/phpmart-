<?php

spl_autoload_register(function ($class) {
    require dirname(__DIR__,2)."/classes/{$class}.php";
});

session_start();