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
			\ICanBoogie\Modules\DIR
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