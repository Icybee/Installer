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

use ICanBoogie\Errors;

/**
 * Requirements for the "activerecord" config.
 */
class ActiveRecordConfigRequirement extends Requirement
{
	public function __construct()
	{
		$this->title = t('requirement.activerecord_config.title');
		$this->description = t
		(
			'requirement.activerecord_config.description', array
			(
				'action' => new TellMeMore('activerecord_config'),
				'data' => '<textarea class="span8" readonly="readonly">' . \ICanBoogie\escape($this->get_data()) . '</textarea>'
			)
		);
	}

	/**
	 * Checks that the "activerecord" config exists or can be created.
	 */
	public function __invoke(Errors $errors)
	{
		$pathname = WEBSITE_CONFIG_DIR . 'activerecord.php';

		if (file_exists($pathname))
		{
			return;
		}

		if (is_writable($pathname))
		{
			file_put_contents($pathname, $data);

			return;
		}

		$errors['activerecord_config'] = t('requirement.activerecord_config.error.not_writable', array('pathname' => \ICanBoogie\strip_root($pathname)));
	}

	public function get_data()
	{
		global $core;

		$options = $core->session->install['database'];

		$name = $options['name'];
		$host = $options['host'] ?: 'localhost';
		$username = $options['username'];
		$password = $options['password'];
		$prefix = $options['prefix'];

		return <<<EOT
<?php

return [

	'connections' => [

		'primary' => [

			'dsn' => 'mysql:dbname=$name;host=$host',
			'username' => '$username',
			'password' => '$password',
			'#timezone' => '+00.00',
			'#table_name_prefix' => '$prefix'
		]

	]

];
EOT;
	}
}