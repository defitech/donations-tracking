# PayPal donations tracking

Very, very basic donations tracking for the Defitech website:

- PayPal IPN listener page (`source/paypal_notify`) logging notifications and adding donations per campaign (i.e. PayPal API's `item_number`) 
- Totals per campaign are stored in simple text files


## Minimal test

`php test/donations.test.php`


## Deploy

`./deploy.sh`


## Acknowledgements

Uses a modified version of [this PayPal IPN listener class](https://github.com/Quixotix/PHP-PayPal-IPN).