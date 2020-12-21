#!/usr/bin/env php
<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This file is used to run the bot with the getUpdates method.
 */

// Load composer
require_once __DIR__ . '/vendor/autoload.php';

// Load all configuration options
/** @var array $config */
$config = require __DIR__ . '/config.php';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($config['api_key'], $config['bot_username']);

    /**
     * Check `hook.php` for configuration code to be added here.
     */

    $telegram->enableAdmins($config['admins']);
    
     // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($config['commands']['paths']);

    $telegram->enableMySql($config['mysql']);

    /**
     * Check `hook.php` for configuration code to be added here.
     */
    $telegram->setDownloadPath($config['paths']['download']);
    $telegram->setUploadPath($config['paths']['upload']);

    $telegram->enableLimiter($config['limiter']);
    
    foreach ($config['commands']['configs'] as $command_name => $command_config) {
        $telegram->setCommandConfig($command_name, $command_config);
    }

    Longman\TelegramBot\TelegramLog::initialize(
       new Monolog\Logger('telegram_bot', [
           (new Monolog\Handler\StreamHandler($config['logging']['debug'], Monolog\Logger::DEBUG))->setFormatter(new Monolog\Formatter\LineFormatter(null, null, true)),
           (new Monolog\Handler\StreamHandler($config['logging']['error'], Monolog\Logger::ERROR))->setFormatter(new Monolog\Formatter\LineFormatter(null, null, true)),
       ]),
       new Monolog\Logger('telegram_bot_updates', [
           (new Monolog\Handler\StreamHandler($config['logging']['update'], Monolog\Logger::INFO))->setFormatter(new Monolog\Formatter\LineFormatter('%message%' . PHP_EOL)),
       ])
    );

    // Handle telegram getUpdates request
    $server_response = $telegram->handleGetUpdates();

    if ($server_response->isOk()) {
        $update_count = count($server_response->getResult());
        echo date('Y-m-d H:i:s') . ' - Processed ' . $update_count . ' updates';
    } else {
        echo date('Y-m-d H:i:s') . ' - Failed to fetch updates' . PHP_EOL;
        echo $server_response->printError();
        Longman\TelegramBot\TelegramLog::error($server_response->printError());
    }

} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);

    // Uncomment this to output any errors (ONLY FOR DEVELOPMENT!)
    echo $e;
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Uncomment this to output log initialisation errors (ONLY FOR DEVELOPMENT!)
    echo $e;
    Longman\TelegramBot\TelegramLog::error($e);
}
