<?php
 
// $finder = PhpCsFixer\Finder::create()
//     ->in(__DIR__)
//     ->exclude(['bootstrap', 'storage', 'vendor'])
//     ->name('*.php')
//     ->name('_ide_helper')
//     ->notName('*.blade.php')
//     ->ignoreDotFiles(true)
//     ->ignoreVCS(true);
 
// return PhpCsFixer\Config::create()
//     ->setRules([
//         '@PSR2' => true,
//         'array_syntax' => ['syntax' => 'short'],
//         'ordered_imports' => ['sortAlgorithm' => 'alpha'],
//         'no_unused_imports' => true,
//     ])
//     ->setFinder($finder);


$finder = Symfony\Component\Finder\Finder::create()
    ->in(__DIR__)
    ->exclude('bootstrap')
    ->exclude('config')
    ->exclude('database')
    ->exclude('public')
    ->exclude('resources/views')
    ->exclude('storage')
    ->exclude('tests')
    ->exclude('vendor')
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'no_unused_imports' => true,
        'ordered_imports' => true,
        'phpdoc_align' => false,
    ])
    ->setFinder($finder);
