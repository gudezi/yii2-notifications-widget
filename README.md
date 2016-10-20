# yii2-notifications-widget

notifications-widget
====================
list notifications widgets

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist gudezi/yii2-notifications-widget "*"
```

or add

```
"gudezi/yii2-notifications-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php

    // Example of data.
    $data = [
        ['url' => '', 'user' => 'Equipo de soporte','image' => '','time' => '5 min','message' => 'Make Deploy?'],
        ['url' => '', 'user' => 'Equipo de Desarrollo','image' => '','time' => '6 min','message' => 'Make Deploy?']
    ];
    <?= gudezi\notifications\NotificationsWidget::widget(
        [
            'options' => ['class' => 'sidebar-menu'],
            'items' => $itemsMessage,
            'directoryAsset' =>$directoryAsset,
            'type' => gudezi\notifications\NotificationsWidget::TYPE_MESSAGE,
        ]
    ) ?>```