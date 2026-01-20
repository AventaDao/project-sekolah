<?php

namespace App\Logging;

use Monolog\Logger;

class FirebaseLoggerFactory
{
    /**
     * Create a custom logger instance for Firebase.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('firebase');
        $logger->pushHandler(new FirebaseLogger());
        return $logger;
    }
}
