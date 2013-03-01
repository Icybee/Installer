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
 * Checks startup requirements.
 */
class RequirementsOperation extends Operation
{
	protected function get_installer_operation_id()
	{
		return 'welcome';
	}

	protected function validate(Errors $errors)
	{
		return true;
	}

	protected function process()
	{
		$requirements = WelcomeRequirements::get();
		$rendered_requirements = $requirements->render();

		$this->response['requirements_element'] = $rendered_requirements;

		if ($rendered_requirements)
		{
			return;
		}

		$this->response->messages = t('panel.welcome.success');

		return parent::process();
	}
}