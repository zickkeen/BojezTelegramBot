[![Donate](https://img.shields.io/badge/%F0%9F%92%99-Donate%20%2F%20Support%20Us-blue.svg)](#donate)

# Bojez Telegram Bot

> :construction: Work In Progress :construction:

An this project of Telegram bot using the [PHP Telegram Bot][core-github] library.

This project is OpenSource to develope, distribute and usage. 

**:exclamation: Important!**
- **additional security measures need to be added by you**, the developer.
- Before starting this project, make sure you have read the official [readme] [core-readme-github] to understand how the Telegram Bot PHP library works and what it takes to run the Telegram bot.

Let's get started then! :smiley:

## 0. Cloning this repository

To start off, you can clone this repository using git:

```bash
$ git clone https://github.com/zickkeen/BojezTelegramBot.git
```

or better yet, download it as a zip file:

```bash
$ curl -o BojezTelegramBot.zip https://github.com/zickkeen/BojezTelegramBot/archive/master.zip
```

Unzip the files to the root of your project folder.

## 1. Making it yours

Now you can choose what installation you would like, either the default one or using the [Bot Manager][bot-manager-github] project.
Depending on which one you choose, you can delete the files that are not required.

---

First of all, you need to rename `config.example.php` to `config.php` and then replace all necessary values with those of your project.

**Default**
Some of these files require extra configurations to be added. Check `hook.php` how they are loaded.
Thanks to reading the main readme file, you should know what these files do.

- `composer.json` (Describes your project and it's dependencies)
- `set.php` (Used to set the webhook)
- `unset.php` (Used to unset the webhook)
- `hook.php` (Used for the webhook method)
- `getUpdatesCLI.php` (Used for the getUpdates method)
- `cron.php` (Used to execute commands via cron)

**Bot Manager**
Using the bot manager makes life much easier, as all configuration goes into a single file, `manager.php`.

If you decide to use the Bot Manager, be sure to [read all about it][bot-manager-readme-github] and change the `require` block in the `composer.json` file:
```json
"require": {
    "php-telegram-bot/telegram-bot-manager": "*"
}
```

Then, edit the following files, replacing all necessary values with those of your project.

- `composer.json` (Describes your project and it's dependencies)
- `manager.php` (Used as the main entry point for everything)

---

Now you can install all dependencies using [composer]:
```bash
$ composer install
```

## 2. Adding your own commands

You can find a few example commands in the [`Commands`](Commands) folder.

Do **NOT** just copy all of them to your bot, but instead learn from them and only add to your bot what you need.

Adding any extra commands to your bot that you don't need can be a security risk!

## Donate

### Donate to BojezTelegramBot
* [![Paypal](https://img.shields.io/badge/Paypal-zickkeen-blue)](https://paypal.me/donateZickkeen)
* [![Buy Me a coffee](https://img.shields.io/badge/BuyMeCofee-zickkeen-yellow)](https://buymeacoff.ee/zickkeen)
* [![SociaBuzz](https://img.shields.io/badge/SociaBuzz-zickkeen-green)](https://sociabuzz.com/zickkeen/tribe)
* [BitCoin](https://img.shields.io/badge/btc-18xbSr5kmvxzpHEpJ43LAbXqdZ1XcmKQNf-green)
* [![liberapay](https://img.shields.io/liberapay/gives/zickkeen?logo=zickkeen&style=social)](https://liberapay.com/zickkeen)

### Donate to Core TelegramBot Engine
All work on this bot consists of many hours of coding during our free time, to provide you with a Telegram Bot library that is easy to use and extend.
If you enjoy using this library and would like to say thank you, donations are a great way to show your support.

Donations are invested back into the project :+1:

Thank you for keeping this project alive :pray:

- [![Patreon](https://user-images.githubusercontent.com/9423417/59235980-a5fa6b80-8be3-11e9-8ae7-020bc4ae9baa.png) Patreon.com/phptelegrambot][Patreon]
- [![OpenCollective](https://user-images.githubusercontent.com/9423417/59235978-a561d500-8be3-11e9-89be-82ec54be1546.png) OpenCollective.com/php-telegram-bot][OpenCollective]
- [![Ko-fi](https://user-images.githubusercontent.com/9423417/59235976-a561d500-8be3-11e9-911d-b1908c3e6a33.png) Ko-fi.com/phptelegrambot][Ko-fi]
- [![Tidelift](https://user-images.githubusercontent.com/9423417/59235982-a6930200-8be3-11e9-8ac2-bfb6991d80c5.png) Tidelift.com/longman/telegram-bot][Tidelift]
- [![Liberapay](https://user-images.githubusercontent.com/9423417/59235977-a561d500-8be3-11e9-9d16-bc3b13d3ceba.png) Liberapay.com/PHP-Telegram-Bot][Liberapay]
- [![PayPal](https://user-images.githubusercontent.com/9423417/59235981-a5fa6b80-8be3-11e9-9761-15eb7a524cb0.png) PayPal.me/noplanman][PayPal-noplanman] (account of @noplanman)
- [![Bitcoin](https://user-images.githubusercontent.com/9423417/59235974-a4c93e80-8be3-11e9-9fde-260c821b6eae.png) 166NcyE7nDxkRPWidWtG1rqrNJoD5oYNiV][Bitcoin]
- [![Ethereum](https://user-images.githubusercontent.com/9423417/59235975-a4c93e80-8be3-11e9-8762-7a47c62c968d.png) 0x485855634fa212b0745375e593fAaf8321A81055][Ethereum]



## To be continued!

---

[core-github]: https://github.com/php-telegram-bot/core "php-telegram-bot/core"
[core-readme-github]: https://github.com/php-telegram-bot/core#readme "PHP Telegram Bot - README"
[bot-manager-github]: https://github.com/php-telegram-bot/telegram-bot-manager "php-telegram-bot/telegram-bot-manager"
[bot-manager-readme-github]: https://github.com/php-telegram-bot/telegram-bot-manager#readme "PHP Telegram Bot Manager - README"
[composer]: https://getcomposer.org/ "Composer"


[Patreon]: https://www.patreon.com/phptelegrambot "Support us on Patreon"
[OpenCollective]: https://opencollective.com/php-telegram-bot "Support us on Open Collective"
[Ko-fi]: https://ko-fi.com/phptelegrambot "Support us on Ko-fi"
[Tidelift]: https://tidelift.com/subscription/pkg/packagist-longman-telegram-bot?utm_source=packagist-longman-telegram-bot&utm_medium=referral&utm_campaign=enterprise&utm_term=repo "Learn more about the Tidelift Subscription"
[Liberapay]: https://liberapay.com/PHP-Telegram-Bot "Donate with Liberapay"
[PayPal-noplanman]: https://paypal.me/noplanman "Donate with PayPal"
[Bitcoin]: https://www.blockchain.com/btc/address/166NcyE7nDxkRPWidWtG1rqrNJoD5oYNiV "Donate with Bitcoin"
[Ethereum]: https://etherscan.io/address/0x485855634fa212b0745375e593fAaf8321A81055 "Donate with Ethereum"