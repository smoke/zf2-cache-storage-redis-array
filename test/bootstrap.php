<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';

if (!class_exists(PHPUnit_Framework_TestCase::class)) {
    class_alias(TestCase::class, PHPUnit_Framework_TestCase::class);
}
