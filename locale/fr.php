<?php

return array
(
	# bootstrap.php

	'document_title' => "Installer Icybee",

	'panel' => array
	(
		# lib/elements/welcome-form.php

		'welcome' => array
		(
			'success' => "Pré-requis remplis",
			'title' => "Bienvenue",
			'description' => <<<EOT
<h1>Bienvenue à Icybee</h1>

<p>Avant de démarrer, nous devons rassembler quelques informations afin d'installer le logiciel et
mettre en place le site web et le compte d'administration. Dans quelques minutes vous serez
connecté à Icybee et prêt à construire votre site.</p>

:action
EOT
		),

		'database' => array
		(
			'success' => "Paramètres de la base de données sauvegardés",
			'error' => array
			(
				'name' => "Cette base de données n'existe pas ou n'est pas accessible.",
				'username_password' => "Combinaison nom d'utilisateur/mot de passe inconnue.",
				'host' => "Cet hôte de base de données n'existe pas."
			),

			'title' => "Base de données",
			'username' => "Le nom de l'utilisateur à utiliser pour se connecter à la base de données.",
			'name' => "Le nom de la base de données dans laquelle vous souhaitez enregistrer vos données.",
			'prefix' => "Un préfixe pour les tables de la base de données. Cela permet de partager une même base de données entre plusieurs installation d'Icybee.",
			'description' => <<<EOT
Voici les informations requises pour établir une connexion à la base de données. Veuillez contacter
votre hébergeur si vous n'êtes pas sûr de ces paramètres.
EOT
		),

		'site' => array
		(
			'success' => "Paramètres du site web sauvegardés",
			'title' => "Site web",
			'description' => <<<EOT
Voici les informations de base nécessaires à la creation de votre site web. Vous aurez la
possibilité de les modifier plus tard et en spécifier d'autres tels que son emplacement, son
status, le code Google Analytics, et plus encore. Vous pourrez également créer et gérer d'autres
sites web, dans d'autres langues par exemple.
EOT
		),

		'user' => array
		(
			'success' => "Paramètres du compte admin sauvegardées",
			'error' => array
			(
				'password_match' => "Les mots de passe ne correspondent pas."
			),

			'title' => "Compte administrateur",
			'description' => <<<EOT
Voici les informations de base nécessaires à la création de votre compte administrateur. Vous
pourrez modifier ses paramètres plus tard et en spécifier d'autres tels que votre prénom, nom,
pseudonyme, la façon dont votre nom doit s'afficher, votre fuseau horaire, et plus encore.
EOT
			,
			'username' => "Vous pouvez vous connecter en utilisant votre identifiant ou votre courriel.",
			'email' => "Assurez-vous de saisir une adresse courriel valide, elle sera votre seul espoir si jamais vous oubliez votre mot de passe.",
			'password' => "Le mot de passe devrait faire au mieux sept caractères de long. Pour le renforcer, utilisez un mélange de majuscules et de minuscules, de nombres et de symboles tel que ! \" ? $ % ^ & ).",
			'password_confirm' => "Veuillez confirmer votre mot de passe.",
			'language' => "Avec Icybee vous n'avez pas besoin de parler Japonais pour administrer un site en Japonais. Vous pouvez choisir une langue différente de celle du site pour l'interface d'administration."
		),

		'install' => array
		(
			'title' => "Installation",
			'content' => <<<EOT
<h2>Prêt pour l'installation</h2>

<p>Tout est prêt pour l'installation d'Icybee.</p>

<p>:action</p>
EOT
		)
	),

	'requirement' => array
	(
		# lib/requirements/core-config.php

		'core_config' => array
		(
			'error' => array
			(
				'not_writable' => "Impossible d'écrire la configuration&nbsp;: <code>!pathname</code>"
			),

			'title' => "La configuration <q>core</q>",
			'description' => <<<EOT
La configuration <q>core</q> contient les paramètres requis pour se connecter à la base de
données (entre autres choses). Les lignes suivantes ont été créées en fonction des paramètres que
vous avez fourni. Veuillez les copier dans le fichier de configuration. :action

:data
EOT
		),

		# lib/requirements/repository.php

		'repository' => array
		(
			'error' => array
			(
				'not_writable' => "Impossible d'écrire sur le dossier: <code>:dir</code>",
				'missing' => "Le dossier est manquant: <code>:dir</code>"
			),

			'title' => "Le dossier <q>repository</q>",
			'description' => <<<EOT
Le dossier <q>repository</q> est utilisé pour stocker les fichiers gérés par Icybee, les miniatures
créées pour vos images, quelques caches et quelques paramètres. Afin que PHP soit capable de modifier
le contenu du dossier, son propriétaire devrait être <code>www-data</code> et ses permissions misent
à <code>755</code>. :action
EOT
		),

		# lib/requirements/user-config.php

		'user_config' => array
		(
			'error' => array
			(
				'create' => "Le fichier de configuration est manquant et n'a pas pu être créé&nbsp: <code>:path</code>"
			),

			'title' => "La configuration <q>user</q>",
			'description' => <<<EOT
La configuration <q>user</q> contient les paramètres requis pour la gestion des mots de passe.
Les lignes suivantes ont été créées spécialement pour vous. Veuillez les copier dans le fichier de
configuration. :action

:data
EOT
		)
	),

	'language.description' => "D'autres langues peuvent être utilisées grâce à des packs de langue.",

	"Check again" => "Vérifier à nouveau",
	"Let's go!" => "C'est parti !",
	"Continue" => "Continuer",
	"Tell me more…" => "En savoir plus…",
	"Before we can continue, you need to check the following things:" => "Avant de continuer, vous devriez vérifier les choses suivantes:",
	"User name" => "Nom d'utilisateur",
	"Password" => "Mot de passe",
	"Database name" => "Nom de la <abbr title=\"base de données\">BDD</abbr>",
	"Database host" => "Hôte de la <abbr title=\"base de données\">BDD</abbr>",
	"Table prefix" => "Préfixe des tables",
	"Unknown username/password combination." => "Combinaison nom d'utilisateur/mot de passe inconnue.",
	"Title" => "Titre",
	"Language" => "Langage",
	"Timezone" => "Fuseau horaire",
	"Your E-mail" => "Courriel",
	"Username" => "Identifiant",
	"Password confirm" => "Confirmation mot de passe",
	"Install" => "Installer"
);