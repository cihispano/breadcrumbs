<?php
/*
 * Copyright (c) 2022.
 * This file is part of CiHispano Breadcrumbs library.
 *
 * @copyright CiHispano <administracion@cihispano.org>
 * @license For the full copyright and license information, please view  the LICENSE file that was distributed with this source code.
 *
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([__DIR__, './src'])
    ->files()
    ->exclude([
        'build',
        'vendor',
    ])
    ->ignoreVCSIgnored(true)
    ->ignoreDotFiles(false)
    ->append([__FILE__])
;
$config = new PhpCsFixer\Config();
$config->setRules([
    '@PhpCsFixer' => true,
    '@PSR12' => true,
    'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']],
    'modernize_strpos' => true,
    'array_syntax' => ['syntax' => 'short'],
    'control_structure_braces' => true,
    'constant_case' => ['case' => 'lower'],
    'declare_strict_types' => true,
    'array_indentation' => true,
    'list_syntax' => ['syntax' => 'short'],
    'no_unused_imports' => true,
    'phpdoc_indent' => true,
    'ordered_class_elements' => [
        'order' => [
            'use_trait',
            'constant',
            'property',
            'method',
        ],
        'sort_algorithm' => 'none',
    ],
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
        'imports_order' => ['class', 'function', 'const'],
    ],
    'yoda_style' => [
        'equal' => true,
        'identical' => true,
        'less_and_greater' => false,
        'always_move_variable' => false,
    ],
    'trailing_comma_in_multiline' => [
        'after_heredoc' => true,
        'elements' => ['arrays'],
    ],
    'trim_array_spaces' => true,
    'statement_indentation' => true,
    'global_namespace_import' => [
        'import_functions' => false,
        'import_classes' => false,
    ],
])
    ->setFinder($finder)
    ->setCacheFile('build/.php-cs-fixer.cache')
    ->setRiskyAllowed(true)
;

return $config;
