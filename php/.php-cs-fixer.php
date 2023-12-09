<?php

$cacheDirectory = __DIR__ . '/var/php-cs-fixer';
if (!\file_exists($cacheDirectory)) {
    \mkdir($cacheDirectory);
}

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setCacheFile($cacheDirectory . '/php_cs.cache')
    ->setRules([
        '@PSR12' => true,
        '@PHP83Migration' => true,
        '@PHPUnit100Migration:risky' => true,
    ])
    ->setFinder($finder);