<?php

return [


    'driver' => 'smtp',

    'host' => 'p3plcpnl0554.prod.phx3.secureserver.net',

    'port' => '587',

    'from' => [
        'address' => 'contacto@bitstoresv.com',
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    'encryption' => 'tls',

    'username' => 'b888h8z7c1nt',

    'password' => 'Y.i.berber1',

    'sendmail' => '/usr/sbin/sendmail -bs',

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channel
    |--------------------------------------------------------------------------
    |
    | If you are using the "log" driver, you may specify the logging channel
    | if you prefer to keep mail messages separate from other log entries
    | for simpler reading. Otherwise, the default channel will be used.
    |
    */

    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
