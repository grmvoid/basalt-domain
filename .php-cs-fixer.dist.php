<?php declare(strict_types=1);

/*
 * This file is part of the grmvoid/basalt-events.
 *
 * Copyright (C) Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

$fileHeaderParts = [
    <<<'EOF'
        This file is part of the grmvoid/basalt-events.

        Copyright (C) Dominik Szamburski

        EOF,
    <<<'EOF'

        This software may be modified and distributed under the terms
        of the MIT license. See the LICENSE file for details.
        EOF,
];

$finder = \PhpCsFixer\Finder::create()
    ->name('*.php')
    ->in([__DIR__ . '/src', __DIR__ . '/tests'])
    ->ignoreDotFiles(false)
    ->ignoreVCSIgnored(true);

$config = new \PhpCsFixer\Config();
$config
    ->setParallelConfig(\PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'declare_strict_types' => true,
        'no_unused_imports' => true,
        'single_quote' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_trailing_whitespace' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'strict_comparison' => true,
        'no_extra_blank_lines' => true,
        'no_superfluous_phpdoc_tags' => true,
        'no_unreachable_default_argument_value' => true,
        'void_return' => true,
        'return_type_declaration' => ['space_before' => 'none'],
        'header_comment' => [
            'header' => implode('', $fileHeaderParts),
            'validator' => implode('', [
                '/',
                preg_quote($fileHeaderParts[0], '/'),
                '(?P<EXTRA>.*)??',
                preg_quote($fileHeaderParts[1], '/'),
                '/s',
            ]),
        ],
    ]);

return $config;
