<?php

Yii::import('ext.ELogEntriesLogRoute.vendors.lephp.*');
require_once('LeLogger.php');

/**
 * ELogEntriesLogRoute class file
 *
 * Enables logging to logentries.com via Yii's logging mechanism
 *
 * @author Iain Gray <igray@itgassociates.com>
 * @copyright 2013 Iain Gray
 * @license BSD
 */
class ELogEntriesLogRoute extends CLogRoute{

    /**
     * @var string LogEntries API Token
     */
    public $leToken;

    /**
     * Use persistent connection?
     * @var bool
     */
    public $persistent = true;

    /**
     * Use ssl for logging?
     * @var bool
     */
    public $ssl = false;

    /**
     * @var LeLogger Log Entries Logger Instance
     */
    private $leLogger;

    /**
     * Initializes the route by setting up the logger
     */
    public function init()
    {
        parent::init();
        $this->leLogger = LeLogger::getLogger($this->leToken, $this->persistent, $this->ssl, LOG_DEBUG);
    }

    /**
     * Processes log messages into individual lines
     * @param array $logs
     */
    protected function processLogs($logs)
    {
        foreach($logs as $line)
        {
            list($message, $level, $category) = $line;
            $this->_sendToLe($category.' - '.$message, $level);
        }
    }

    /**
     * Sends the log to logentries.com
     * @param string $message
     * @param string $level
     */
    private function _sendToLe($message, $level)
    {
        //map of levels from Yii -> Logentries supported levels
        $levelMap = array(
            'trace'=> 'Debug',
            'info' => 'Info',
            'profile'=> 'Debug',
            'warning'=>'Warn',
            'error'=>'Error'
        );

        //set default map if it doesn't exist
        if(!isset($levelMap[$level]))
            $levelMap[$level]='Notice';

        //log at the selected level
        $this->leLogger->$levelMap[$level]($message);
    }
}