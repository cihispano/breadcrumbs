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

use Cihispano\Breadcrumbs\Crumb;
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
class CrumbTest extends TestCase
{
    public function testCrumbConstruct(): void
    {
        $text = 'Admin';
        $link = 'admin/index.php';
        $crumb = new Crumb($text, $link);
        self::assertInstanceOf(Crumb::class, $crumb);
        self::assertSame($text, $crumb->text);
        self::assertSame($link, $crumb->link);
    }
}
