# PayPal donations tracking

Very, very basic donations tracking for the Defitech website:

- PayPal IPN listener page (`source/paypal_notify`) logging notifications and adding donations per campaign (i.e. PayPal API's `item_number`) 
- Totals per campaign are stored in simple text files


## Example usage

In PayPal (e.g. 'Donate' button setup), configure the desired campaign id and set the IPN listener URL to where you published `paypal_notify.php`.
On your webpage, require `donations.php` and retrieve the current donations total with `Donations::getTotal`.

E.g. this displays the total for campaign `{campaign id}` and displays a basic progress bar:

```php
<div id="fundraising-status">
  <?php
require("{path to donations.php}");
$total = Donations::getTotal("{campaign id}");
$goal = 10000;
$percentage = min(round($total / $goal * 100, 2), 100);
  ?>
  <div id="fundraising-progress">
    <div id="fundraising-progress-percentage" style="width: <?php echo $percentage . "%"; ?>;">
    </div>
    <div id="fundraising-progress-text">
      <?php echo round($total, 2); ?> contributed
    </div>
  </div>
</div>
```


## Testing

`php test/donations.test.php`


## Deploying

`./deploy.sh` (just SCPs source files to the website)


## Acknowledgements

Uses a modified version of [this PayPal IPN listener class](https://github.com/Quixotix/PHP-PayPal-IPN).