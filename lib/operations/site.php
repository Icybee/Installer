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

use ICanBoogie\I18n;

class SiteOperation extends Operation
{
	protected function get_controls()
	{
		return array
		(
			self::CONTROL_FORM => true
		)

		+ parent::get_controls();
	}

	protected function get_form()
	{
		return new SiteForm;
	}

	protected function validate(\ICanBoogie\Errors $errors)
	{
		return $errors;
	}

	protected function process()
	{
		global $core;

		$request = $this->request;

		$core->session->install['site'] = array
		(
			'title' => $request['title'],
			'language' => $request['language'],
			'timezone' => $request['timezone']
		);

		$this->response->message = I18n\t('panel.site.success');

		return parent::process();
	}
}