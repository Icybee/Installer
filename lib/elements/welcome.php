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

use Brickrouge\Button;
use Brickrouge\Element;
use Brickrouge\ElementIsEmpty;

/**
 * The "Welcome" panel.
 */
class WelcomePanel extends Element
{
	public function __construct()
	{
		$action = new Button("Let's go!", array('class' => 'btn btn-large', 'type' => 'submit'));

		parent::__construct
		(
			'div', array
			(
				PanelDecorator::TITLE => t('panel.welcome.title'),
				PanelDecorator::DESCRIPTION => t('panel.welcome.description', array('action' => $action)),

				Element::CHILDREN => array
				(
					WelcomeRequirements::get()->render()
				),

				'name' => 'welcome',
				'data-message' => t('panel.welcome.success')
			)
		);
	}

	/**
	 * @throws ElementIsEmpty if the inner HTML is empty.
	 */
	protected function render_inner_html()
	{
		$html = parent::render_inner_html();

		if (!$html)
		{
			throw new ElementIsEmpty;
		}

		return $html;
	}
}