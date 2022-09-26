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

use Cihispano\Breadcrumbs\Breadcrumb;
use Cihispano\Breadcrumbs\BreadcrumbConfig;
use Cihispano\Breadcrumbs\BreadcrumbException;
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
class BreadcrumbTest extends TestCase
{
    public function testAddBreadcrumbFailsIfGenerateLinksAndNoLinkProvided(): void
    {
        $breadcrumb = new Breadcrumb();
        self::expectException(BreadcrumbException::class);
        $breadcrumb->addBreadcrumb('Admin', '');
    }

    public function testRenderWithNoCrumbs(): void
    {
        $breadcrumb = new Breadcrumb();
        $html = $breadcrumb->render();
        self::assertSame('', $html);
    }

    /**
     * @throws BreadcrumbException
     */
    public function testRenderDefaultConfigAndOneElement(): void
    {
        $breadcrumb = new Breadcrumb();
        $crumb = 'Admin';
        $link = '/admin';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $html = $breadcrumb->render();
        self::assertSame('<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item">Admin</li></ol></nav>', $html);
    }

    /**
     * @throws BreadcrumbException
     */
    public function testRenderDefaultConfigAndThreeElements(): void
    {
        $breadcrumb = new Breadcrumb();
        $crumb = 'Admin';
        $link = '/admin';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Users';
        $link = '/admin/users';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Bills';
        $link = '/admin/users/bills';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $html = $breadcrumb->render();
        self::assertSame('<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="/admin">Admin</a></li>/<li class="breadcrumb-item"><a href="/admin/users">Users</a></li>/<li class="breadcrumb-item">Bills</li></ol></nav>', $html);
    }

    /**
     * @throws BreadcrumbException
     */
    public function testRenderDefaultConfigAndThreeElementsLimit2(): void
    {
        $breadcrumb = new Breadcrumb();
        $crumb = 'Admin';
        $link = '/admin';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Users';
        $link = '/admin/users';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Bills';
        $link = '/admin/users/bills';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $html = $breadcrumb->render(2);
        self::assertSame('<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="/admin">Admin</a></li>/<li class="breadcrumb-item">Users</li></ol></nav>', $html);
    }

    /**
     * @throws BreadcrumbException
     */
    public function testRenderConfigNoLinksAndThreeElementsLimit2(): void
    {
        $breadcrumb = new Breadcrumb(new BreadcrumbConfig(generateLinks: false));
        $crumb = 'Admin';
        $link = '/admin';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Users';
        $link = '/admin/users';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Bills';
        $link = '/admin/users/bills';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $html = $breadcrumb->render(2);
        self::assertSame('<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item">Admin</li>/<li class="breadcrumb-item">Users</li></ol></nav>', $html);
    }

    /**
     * @throws BreadcrumbException
     */
    public function testRenderConfigCustomSeparatorAndThreeElements(): void
    {
        $separator = '>';
        $breadcrumb = new Breadcrumb(new BreadcrumbConfig(separator: $separator));
        $crumb = 'Admin';
        $link = '/admin';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Users';
        $link = '/admin/users';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $crumb = 'Bills';
        $link = '/admin/users/bills';
        $breadcrumb->addBreadcrumb($crumb, $link);
        $html = $breadcrumb->render();
        self::assertSame('<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="/admin">Admin</a></li>'.$separator.'<li class="breadcrumb-item"><a href="/admin/users">Users</a></li>'.$separator.'<li class="breadcrumb-item">Bills</li></ol></nav>', $html);
    }

    /**
     * @throws BreadcrumbException
     */
    public function testRenderDefaultConfigAddingArrayOfCrumbs(): void
    {
        $data = [
            new Crumb('Admin', 'admin'),
            new Crumb('Roles', 'admin/roles'),
            new Crumb('Roles', 'admin/roles'),
        ];
        $breadcrumbs = new Breadcrumb();
        $breadcrumbs->addBreadcrumbs($data);
        $html = $breadcrumbs->render();
        self::assertSame('<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="admin">Admin</a></li>/<li class="breadcrumb-item"><a href="admin/roles">Roles</a></li>/<li class="breadcrumb-item">Roles</li></ol></nav>', $html);
    }
}
