<?php

	use yii\caching\FileCache;

	return [
		'aliases' => [
			'@bower' => '@vendor/bower-asset',
			'@npm' => '@vendor/npm-asset',
		],
		'vendorPath' => dirname(__DIR__, 2) . '/vendor',
		'language' => 'ru-RU',
		'sourceLanguage' => 'ru-RU',
		'components' => [
			'cache' => [
				'class' => FileCache::class,
			],
		],
	];
