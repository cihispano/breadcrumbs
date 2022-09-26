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

namespace Cihispano\Breadcrumbs;

/**
 * @author CiHispano - Jesús Guerreiro Real de Asua
 *
 * @since Version v1.0.0
 */
final class BreadcrumbConfig
{
    public const DEFAULT_GENERATE_LINKS = true;
    public const DEFAULT_NAV_TAG = '<nav aria-label="breadcrumb">';
    public const DEFAULT_OL_TAG = '<ol class="breadcrumb">';
    public const DEFAULT_LI_TAG = '<li class="breadcrumb-item">';
    public const DEFAULT_SEPARATOR = '/';

    public function __construct(
        public readonly bool $generateLinks = self::DEFAULT_GENERATE_LINKS,
        public readonly string $separator = self::DEFAULT_SEPARATOR,
        public readonly string $navTag = self::DEFAULT_NAV_TAG,
        public readonly string $olTag = self::DEFAULT_OL_TAG,
        public readonly string $liTag = self::DEFAULT_LI_TAG
    ) {
    }
}
