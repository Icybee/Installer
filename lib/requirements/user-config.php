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
 * Requirements for the "user" configuration.
 */
class UserConfigRequirement extends Requirement
{
	public function __construct()
	{
		$this->title = t('requirement.user_config.title');
		$this->description = t
		(
			'requirement.user_config.description', array
			(
				'action' => new TellMeMore('user_config'),
				'data' => '<textarea class="span8" readonly="readonly">' . \ICanBoogie\escape($this->get_data()) . '</textarea>'
			)
		);
	}

	public function __invoke(Errors $errors)
	{
		$pathname = WEBSITE_CONFIG_DIR . 'user.php';

		if (file_exists($pathname))
		{
			return;
		}

		if (is_writable($pathname))
		{
			file_put_contents($pathname, $data);

			return;
		}

		$errors['user_config'] = t('requirement.user_config.error.create', array('path' => \ICanBoogie\strip_root($pathname)));
	}

	public function get_data()
	{
		$password_salt = \ICanboogie\generate_token_wide();

		return <<<EOT
<?php

return array
(
	'password_salt' => '$password_salt'
);
EOT;
	}
}