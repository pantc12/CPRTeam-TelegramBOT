# CPRTeam-TelegramBOT

## Install

    git clone https://github.com/pantc12/CPRTeam-TelegramBOT.git
    cd CPRTeam-TelegramBOT
    cp config.sample.php config.php

## Create your Telegram Bot

1. Message [http://telegram.me/BotFather](http://telegram.me/BotFather) and follow the guide to create a new bot
2. Get your token, name and write it to ``config.php``

## Set UP webhook

1. Send a post request to ``https://api.telegram.org/bot{TOKEN}/setWebhook?url={YOUR_WEBHOOK_URL}``
2. You must include your server SSL crt (public key) file in a POST field ``certificate`` (POST type = file)
3. If correct, telegram api should response

```
{
    "ok": true,
    "result": true,
    "description": "Webhook was set"
}
```

## Watch the log
1. Message your bot
2. tail -f hooks.log

The log will contain timestamp and webhook data from telegram webhooks api.