# Breadcrumbs

## Table of Contents

- [About The Project](#about-the-project)
- [Getting started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [License](#license)

## About The Project

Simple breadcrumb library for PHP 8.1 and above.

## Getting started

### Prerequisites

 - PHP 8.1 or above

### Installation

## Usage

The simplest way for the library is

- Create an object
- Add the paths
- Render.

```php
$breadcrumbs = new Breadcrumbs();
$breadcrumbs->addBreadcrumb('Admin','https://localhost/admin');
$breadcrumbs->addBreadcrumb('Users','https://localhost/admin/users');
$breadcrumbs->addBreadcrumb('Roles','https://localhost/admin/users/roles');
$html = $breadcrumbs->render();
```

You can use a custom configuration passing a BreadcrumbConfig objet to the constructor

```php
$navTag = '<nav class="test" aria-label="breadcrumb">';
$olTag = '<ol class="breadcrumb" type="1">';
$liTag = '<li class="breadcrumb-item" value="2">';
$separator = '-';

$config = new BreadcrumbConfig(
    !BreadcrumbConfig::DEFAULT_GENERATE_LINKS,
    $separator,
    $navTag,
    $olTag,
    $liTag
);
```

If you want more examples, watch `test/BreadcrumbTest.php`.

## License

See [LICENSE](LICENSE).
