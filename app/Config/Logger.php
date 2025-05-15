<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Log\Handlers\FileHandler;

class Logger extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Error Logging Threshold
     * --------------------------------------------------------------------------
     *
     * You can enable error logging by setting a threshold over zero. The
     * threshold determines what gets logged. Any values below or equal to the
     * threshold will be logged.
     *
     * Threshold options are:
     *
     * - 0 = Disables logging, Error logging TURNED OFF
     * - 1 = Emergency Messages - System is unusable
     * - 2 = Alert Messages - Action Must Be Taken Immediately
     * - 3 = Critical Messages - Application component unavailable, unexpected exception.
     * - 4 = Runtime Errors - Don't need immediate action, but should be monitored.
     *
     * Note: CodeIgniter 4 officially supports thresholds up to 4.
     *
     * For a live site you'll usually enable Critical or higher (3) to be logged otherwise
     * your log files will fill up very fast.
     *
     * @var int|list<int>
     */
    public $threshold = 4; // Log sampai level Runtime Errors (Error, Warning, Notice)

    /**
     * --------------------------------------------------------------------------
     * Date Format for Logs
     * --------------------------------------------------------------------------
     *
     * Each item that is logged has an associated date. You can use PHP date
     * codes to set your own date formatting
     */
    public string $dateFormat = 'Y-m-d H:i:s';

    /**
     * --------------------------------------------------------------------------
     * Log Handlers
     * --------------------------------------------------------------------------
     *
     * The logging system supports multiple actions to be taken when something
     * is logged. This is done by allowing for multiple Handlers, special classes
     * designed to write the log to their chosen destinations, whether that is
     * a file on the server, a cloud-based service, or even taking actions such
     * as emailing the dev team.
     *
     * Each handler is defined by the class name used for that handler, and it
     * MUST implement the `CodeIgniter\Log\Handlers\HandlerInterface` interface.
     *
     * The value of each key is an array of configuration items that are sent
     * to the constructor of each handler. The only required configuration item
     * is the 'handles' element, which must be an array of integer log levels.
     *
     * Handlers are executed in the order defined in this array, starting with
     * the handler on top and continuing down.
     *
     * @var array<class-string, array<string, int|list<string>|string>>
     */
    public array $handlers = [
        FileHandler::class => [
            // The log levels that this handler will handle (integer levels).
            // Correspond to PSR-3 levels mapped to CodeIgniter numeric levels:
            // 1 Emergency, 2 Alert, 3 Critical, 4 Error, 5 Warning, 6 Notice, 7 Info, 8 Debug
            'handles' => [1, 2, 3, 4, 5, 6, 7, 8],

            /*
             * The default filename extension for log files.
             * Leaving it blank will default to 'log'.
             */
            'fileExtension' => '',

            /*
             * The file system permissions to be applied on newly created log files.
             * IMPORTANT: Must be an integer (no quotes) and use octal notation (e.g. 0644)
             */
            'filePermissions' => 0644,

            /*
             * Logging Directory Path
             * By default, logs are written to WRITEPATH . 'logs/'
             * Specify a different destination here if desired.
             */
            'path' => '',
        ],
    ];
}
