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
final class BreadcrumbException extends \Exception
{
    public const REQUIRED_LINK = 'Link is required';
    public const REQUIRED_CRUMB = 'Crumb is required';
}
