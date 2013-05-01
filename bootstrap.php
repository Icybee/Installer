<?php

/*
 * This file is part of the Icybee/Installer package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Installer;

/**
 * The directory of the installer.
 *
 * @var string
 */
define('Icybee\Installer\DIR', rtrim(__DIR__, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR);

/**
 * Path to the installer's assets directory.
 *
 * @var string
 */
define('Icybee\Installer\ASSETS', DIR . 'public' . DIRECTORY_SEPARATOR);

/**
 * Path to the website's config directory
 *
 * @var string
 */
define('Icybee\Installer\WEBSITE_CONFIG_DIR', \ICanBoogie\DOCUMENT_ROOT . 'protected' . DIRECTORY_SEPARATOR . 'all' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);