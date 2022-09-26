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
 * Generates breadcrumbs as HTML.
 *
 * @author CiHispano - Jesús Guerreiro Real de Asua
 *
 * @since Version v1.0.0
 */
final class Breadcrumb
{
    private const NAV_TAG_CLOSE = '</nav>';
    private const OL_TAG_CLOSE = '</ol>';
    private const LI_TAG_CLOSE = '</li>';

    private bool $generateLinks = true;
    private string $separator = BreadcrumbConfig::DEFAULT_SEPARATOR;
    private string $navTag = BreadcrumbConfig::DEFAULT_NAV_TAG;
    private string $olTag = BreadcrumbConfig::DEFAULT_OL_TAG;
    private string $liTag = BreadcrumbConfig::DEFAULT_LI_TAG;

    /** @var Crumb[] */
    private array $crumbs = [];

    public function __construct(?BreadcrumbConfig $config = null)
    {
        if ($config instanceof BreadcrumbConfig) {
            $this->generateLinks = $config->generateLinks;
            $this->navTag = $config->navTag;
            $this->olTag = $config->olTag;
            $this->liTag = $config->liTag;
            $this->separator = $config->separator;
        }
    }

    public function render(?int $maxLevels = null): string
    {
        $data = null === $maxLevels ? $this->crumbs : array_slice($this->crumbs, 0, max(0, $maxLevels), true);
        if (0 === count($data)) {
            return '';
        }
        $indexNoLink = count($data) - 1;
        $output = $this->navTag.$this->olTag;
        foreach ($data as $index => $crumb) {
            $separator = $index !== $indexNoLink ? $this->separator : '';
            if ($this->generateLinks && $index !== $indexNoLink) {
                $linkOpen = sprintf('<a href="%s">', $crumb->link);
                $linkClose = '</a>';
            } else {
                $linkOpen = '';
                $linkClose = '';
            }
            $output .= $this->liTag.$linkOpen.$crumb->text.$linkClose.self::LI_TAG_CLOSE.$separator;
        }
        $output .= self::OL_TAG_CLOSE.self::NAV_TAG_CLOSE;

        return $output;
    }

    /**
     * @throws BreadcrumbException
     */
    public function addBreadcrumb(string $crumb, string $link): bool
    {
        $link = trim($link);
        if ($this->generateLinks && '' === $link) {
            throw new BreadcrumbException(BreadcrumbException::REQUIRED_LINK);
        }
        $crumb = trim($crumb);
        if ('' === $crumb) {
            throw new BreadcrumbException(BreadcrumbException::REQUIRED_CRUMB);
        }

        $this->crumbs[] = new Crumb($crumb, $link);

        return true;
    }

    /**
     * @param array<Crumb> $data
     *
     * @throws BreadcrumbException
     */
    public function addBreadcrumbs(array $data = []): void
    {
        foreach ($data as $crumb) {
            $this->addBreadcrumb($crumb->text, $crumb->link);
        }
    }
}
