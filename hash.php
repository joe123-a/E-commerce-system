<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

// Create a simple app config (we only need security component)
$config = [
    'id' => 'hash-app',
    'basePath' => __DIR__,
    'components' => [
        'security' => [
            'class' => 'yii\base\Security',
        ],
    ],
];

$app = new yii\console\Application($config);

echo Yii::$app->security->generatePasswordHash("123456") . PHP_EOL;
