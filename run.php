<?php

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

#
# patches
#

\Brickrouge\Helpers::patch('render_exception', 'ICanBoogie\Debug::format_alert');
\Brickrouge\Helpers::patch('t', __NAMESPACE__ . '\t');

#
# application
#

$core = new \Icybee\Core
(
	array
	(
		'config paths' => array
		(
			__DIR__,
			\Icybee\DIR
		),

		'locale paths' => array
		(
			__DIR__,
			\Icybee\DIR
		),

		'modules paths' => array
		(
			\Icybee\DIR . 'modules' . DIRECTORY_SEPARATOR,
			dirname(__DIR__) . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR
		)
	)
);

$_SERVER['ICANBOOGIE_READY_TIME_FLOAT'] = microtime(true);

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