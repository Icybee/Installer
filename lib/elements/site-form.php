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

use Brickrouge\Element;
use Brickrouge\Form;
use Brickrouge\Group;
use Brickrouge\Text;
use Brickrouge\Widget\TimeZone;

class SiteForm extends PanelForm
{
	public function __construct()
	{
		global $core;

		$values = array();

		if (isset($core->session->install['site']))
		{
			$values = $core->session->install['site'];
		}

		parent::__construct
		(
			array
			(
				PanelDecorator::TITLE => t('panel.site.title'),
				PanelDecorator::DESCRIPTION => t('panel.site.description'),

				Form::VALUES => $values + array
				(
					'language' => $core->language,
					'timezone' => date_default_timezone_get() ?: 'UTC'
				),

				Element::CHILDREN => array
				(
					'title' => new Text
					(
						array
						(
							Group::LABEL => 'Title',
							Element::REQUIRED => true
						)
					),

					'language' => new LanguageElement
					(
						array
						(
							Group::LABEL => 'Language',
							Element::REQUIRED => true,
							Element::DEFAULT_VALUE => $core->language
						)
					),

					'timezone' => new TimeZone
					(
						array
						(
							Group::LABEL => 'Timezone',
							Element::REQUIRED => true
						)
					)
				),

				'action' => '/api/install/site',
				'name' => 'site'
			)
		);
	}
}