<?php

namespace Icybee\Installer;

return array
(
	'installer:index' => array
	(
		'pattern' => '/',
		'controller' => __NAMESPACE__ . '\StepsController'
	),

	/*
	 * API
	 */

	'api:installer:requirements' => array
	(
		'pattern' => '/api/install/requirements',
		'controller' => __NAMESPACE__ . '\RequirementsOperation'
	),

	'api:installer:database' => array
	(
		'pattern' => '/api/install/database',
		'controller' => __NAMESPACE__ . '\DatabaseOperation'
	),

	'api:installer:site' => array
	(
		'pattern' => '/api/install/site',
		'controller' => __NAMESPACE__ . '\SiteOperation'
	),

	'api:installer:user' => array
	(
		'pattern' => '/api/install/user',
		'controller' => __NAMESPACE__ . '\UserOperation'
	),

	'api:installer:install' => array
	(
		'pattern' => '/api/install/install',
		'controller' => __NAMESPACE__ . '\InstallOperation'
	)
);