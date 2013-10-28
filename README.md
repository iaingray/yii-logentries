yii-logentries
==============

Yii Wrapper for Logentries.com PHP Class

To use:

1. Download files to into Yii's extensions folder
2. Generate an API key at Logentries.com
3. Add the log route into the config file log section as follows:

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

