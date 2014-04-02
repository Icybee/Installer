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

/**
 * Forwards calls to {@link \ICanBoogie\I18n\t}
 */
function t($str, array $args=array(), array $options=array())
{
	return \ICanBoogie\I18n\t($str, $args, $options);
}

/**
 * Starts the installer.
 *
 * @return \Icybee\Core
 */
function start()
{
	\Brickrouge\Helpers::patch('render_exception', 'ICanBoogie\Debug::format_alert');
	\Brickrouge\Helpers::patch('t', __NAMESPACE__ . '\t');

	$autoconfig = \ICanBoogie\array_merge_recursive(\ICanBoogie\get_autoconfig(), [

		'config-path' => [

			__DIR__ . DIRECTORY_SEPARATOR . 'config'

		],

		'locale-path' => [

			__DIR__ . DIRECTORY_SEPARATOR . 'locale'

		]

	]);

	$core = new \ICanBoogie\Core($autoconfig);

	$_SERVER['ICANBOOGIE_READY_TIME_FLOAT'] = microtime(true);

	#
	# disable the `sites` module
	#

	$core->modules->disable('sites');

	#
	# session
	#

	$core->session = \ICanBoogie\Session::get_session($core);

	#
	# language
	#

	if (isset($_GET['hl']))
	{
		$core->session->install['locale'] = $_GET['hl'];
	}

	if (isset($core->session->install['locale']))
	{
		$core->locale = $core->session->install['locale'];
	}

	#
	# document
	#

	$core->document = \Brickrouge\get_document();

	return $core;
}