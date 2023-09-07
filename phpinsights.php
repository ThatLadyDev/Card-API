<?php

use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits;
use NunoMaduro\PhpInsights\Domain\Metrics\Complexity\Complexity;
use NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousTraitNamingSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowShortTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowArrayTypeHintSyntaxSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;

return [
    'config' => [
        LineLengthSniff::class => [
            'lineLimit' => 120,
            'absoluteLineLimit' => 160,
            'ignoreComments' => false,
        ],
    ],
    'remove' => [
        Complexity::class,
        NoEmptyCommentFixer::class,
        DeclareStrictTypesSniff::class,
        ForbiddenNormalClasses::class,
        SuperfluousExceptionNamingSniff::class,
        ForbiddenTraits::class,
        SuperfluousTraitNamingSniff::class,
        PropertyTypeHintSniff::class,
        ParameterTypeHintSniff::class,
        ForbiddenSetterSniff::class,
        UnusedParameterSniff::class,
        DisallowArrayTypeHintSyntaxSniff::class,
        DisallowShortTernaryOperatorSniff::class,
        ReturnTypeHintSniff::class,
    ],
];
