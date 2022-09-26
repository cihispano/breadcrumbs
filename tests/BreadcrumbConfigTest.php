<?php

declare(strict_types=1);
/*
 * Copyright (c) 2022.
 * This file is part of CiHispano Breadcrumbs library.
 *
 * @copyright CiHispano <administracion@cihispano.org>
 * @license For the full copyright and license information, please view  the LICENSE file that was distributed with this source code.
 *
 */

namespace Cihispano\Tests;

use Cihispano\Breadcrumbs\BreadcrumbConfig;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @group valueObject
 *
 * @author CiHispano - Jesús Guerreiro Real de Asua
 *
 * @since Version v1.0.0
 *
 * @covers
 */
class BreadcrumbConfigTest extends TestCase
{
    public function testDefaultConfig(): void
    {
        $config = new BreadcrumbConfig();
        self::assertInstanceOf(BreadcrumbConfig::class, $config);
        self::assertSame(BreadcrumbConfig::DEFAULT_GENERATE_LINKS, $config->generateLinks);
        self::assertSame(BreadcrumbConfig::DEFAULT_SEPARATOR, $config->separator);
        self::assertSame(BreadcrumbConfig::DEFAULT_NAV_TAG, $config->navTag);
        self::assertSame(BreadcrumbConfig::DEFAULT_OL_TAG, $config->olTag);
        self::assertSame(BreadcrumbConfig::DEFAULT_LI_TAG, $config->liTag);
    }

    public function testPersonalizedConfig(): void
    {
        $navTag = '<nav class="test" aria-label="breadcrumb">';
        $olTag = '<ol class="breadcrumb" type="1">';
        $liTag = '<li class="breadcrumb-item" value="2">';
        $separator = '-';

        $config = new BreadcrumbConfig(
            !BreadcrumbConfig::DEFAULT_GENERATE_LINKS,// @phpstan-ignore-line
            $separator,
            $navTag,
            $olTag,
            $liTag
        );
        // @phpstan-ignore-next-line
        self::assertSame(!BreadcrumbConfig::DEFAULT_GENERATE_LINKS, $config->generateLinks);
        self::assertSame($separator, $config->separator);
        self::assertSame($navTag, $config->navTag);
        self::assertSame($olTag, $config->olTag);
        self::assertSame($liTag, $config->liTag);
    }
}
