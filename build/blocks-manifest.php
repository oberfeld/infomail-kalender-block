<?php
// This file is generated. Do not modify it manually.
return array(
	'infomail-kalender-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'infomail-kalender-block/infomail-kalender-block',
		'version' => '0.1.0',
		'title' => 'Infomail Kalender Block',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Zeigt eine Auswahl von Terminen fürs Oberfeld-Infomail in einer Tabelle an.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'startDate' => array(
				'type' => 'string',
				'default' => ''
			),
			'endDate' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'textdomain' => 'infomail-kalender-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	)
);
