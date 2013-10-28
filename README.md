yii-logentries
==============

Yii Wrapper for Logentries.com PHP Class

To use:

1. Download files to into Yii's extensions folder
2. Get the le_php files (they are a git submodule, so git submodule init follosed by git submodule update)
3. Generate an API key at Logentries.com
4. Add the log route into the config file log section as follows:

```php
'log'=>array(
  'class'=>'CLogRouter',
   'routes'=>
   array(
     array(
       'class'=>'CFileLogRoute',
       'levels'=>'error, warning',
        ),
     array(
        'class' => 'ext.yii-logentries.ELogEntriesLogRoute',
        'leToken' => 'TOKEN HERE',
        ),			
    ),
),
```

5. Add the path to the yii-logentries/vendors to the import section in the main.conf e.g.

```php
    'import'=>array(
    		'application.models.*',
    		'application.components.*',
            'ext.ELogEntriesLogRoute.vendors.lephp.*',
    ),
```

