/*
 * This file is part of the Icybee/Install package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

window.addEvent('domready', function() {

	var body = document.body
	, panels = null
	, activeBeforeBodyChange = null

	document.id('hl').addEvent('change', function(ev) {

		var hl = ev.target.get('value')

		new Request.HTML({

			url: '?hl=' + hl,

			onRequest: function()
			{
				activeBeforeBodyChange = body.getElement('.install-panel.active').id
			},

			onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript) {

				Object.each(responseTree, function(el) {

					if (el.className == 'actionbar')
					{
						el.getElement('h1').replaces(body.getElement('.actionbar h1'))
					}
					else if (el.className == 'container')
					{
						el.replaces(body.getElement('.container'))
					}
				})

				document.html.set('lang', hl)

				updatePanels()

				if (activeBeforeBodyChange)
				{
					var active = body.getElement('.install.active')
					, toActivate = document.id(activeBeforeBodyChange)

					if (active && toActivate)
					{
						active.removeClass('active')
					}

					if (toActivate)
					{
						toActivate.addClass('active')
					}
				}

			}
		}).get()
	})

	function updatePanels()
	{
		panels = body.getElements('.install-panel')
		welcome = panels.shift()
		install = panels[3];

		panels.each(function(panel, i) {

			var formEl = panel.getElement('form')

			if (!formEl) return

			new Brickrouge.Form(formEl, {

				useXHR: true,

				onSuccess: function(response) {

					flashAlert(panel, response.message)

					panel.removeClass('active')
					panel.addClass('done')

					nextPanel()

				}
			})
		})
	}

	function activatePanel(panel)
	{
		panel.getElements('.alert').destroy()
		panel.addClass('active')
	}

	function nextPanel()
	{
		var active = body.getElement('.install-panel.active')
		, panel = null

		if (active)
		{
			panel = active.getNext('.resume')

			if (panel)
			{
				panel.removeClass('resume')
			}
			else
			{
				panel = active.getNext()
			}
		}

		if (!panel)
		{
			panel = body.getElement('.install-panel:not(.done)')
		}

		if (!panel) return

		if (active)
		{
			active.removeClass('active')
		}

		activatePanel(panel)
	}

	function flashAlert(panel, message)
	{
		var title = panel.getElement('.install-panel-title')
		, alert = title.getElement('small') || new Element('small.alert.alert-success.undissmisable', { text: message })

		title.adopt(alert)

		;(function() { alert.fade('out') }).delay(4000)
	}

	updatePanels()

	body.addEvent('click:relay(.install-panel.done .install-panel-title)', function(ev, el) {

		var resume = body.getElement('.install-panel.active')

		resume.removeClass('active')
		resume.addClass('resume')

		activatePanel(el.getParent('.install-panel'))
	})

	// auto-select textarea content

	body.addEvent('click:relay(.install-panel textarea)', function(ev, el) {

		el.focus()
		el.select()

	})

	// welcome

	body.addEvent('click:relay(.install-panel--welcome button)', function(ev, el) {

		new Request.API({

			url: 'install/requirements',

			onSuccess: function(response)
			{
				var content = welcome.getElement('.install-panel-content')

				if (content)
				{
					content.destroy()
				}

				welcome.addClass('no-content')
				welcome.addClass('done')

				nextPanel()

				flashAlert(welcome, welcome.get('data-message'))
			},

			onFailure: function(xhr, response)
			{
				if (!response.requirements_element) return

				var requirements = response.requirements_element
				, content = welcome.getElement('.install-panel-content')

				if (content)
				{
					content.innerHTML = requirements
				}
				else
				{
					new Element('.install-panel-content', { html: requirements })
					.inject(welcome.getElement('.install-panel-inner'))
				}

				welcome.removeClass('no-content')
			}

		}).get()
	})

	// install

	body.addEvent('click:relay(.install-panel--install button)', function(ev, el) {

		new Request.API({

			url: 'install/install',

			onSuccess: function(response)
			{

			},

			onFailure: function(xhr, response)
			{
				if (response.content)
				{
					var content = response.content
					, el = install.getElement('.install-panel-content')

					if (el)
					{
						el.innerHTML = content
					}
					else
					{
						new Element('.install-panel-content', { html: content })
						.inject(install.getElement('.install-panel-inner'))
					}

					install.removeClass('no-content')
				}
				else if (response.errors)
				{
					var messages = []

					Object.each(response.errors, function(message, id) {

						if (id === '_base' && message.match(/^Unknown operation/))
						{
							document.location = '/admin/'

							return
						}

						if (!message || message === true)
						{
							return
						}

						messages.push(message)
					})

					if (messages.length)
					{
						var alert = new Element('div.alert.alert-danger', { html: '<button class="close" data-dismiss="alert">×</button>' })

						messages.each
						(
							function(message)
							{
								alert.adopt(new Element('p', { html: message }))
							}
						)

						alert.inject(install.getElement('.install-panel-content'), 'top')
					}
				}
			}

		}).get()
	})

	body.getElement('.install-panel:not(.done)').addClass('active')
})