
<?php
return array(
    // set your paypal credential
    'client_id' => 'ARnXqrS_g8Xus31fQI65dIJklGT8XdLxIRxh31nEcCdoWI7TcYkqUjkFXXoIJ9_9Eaz1a4LQ-Z5mWOWG',
    'secret' => 'EJtIIk2kh6obR9O6H01auHVc7DvDg9GlaZwxCWzisQQ2mF-YpzwG_mpLnG9dVjP6PHv7V1q9Y6hB-6Q-',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);