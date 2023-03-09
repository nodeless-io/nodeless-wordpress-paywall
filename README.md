# Nodeless Paywall for WordPress



Nodeless Paywall is a plugin for WordPress to accept instant Bitcoin Lightning payments.
It allows you to monetize any digital content with instant microtransactions and receive payments from your visitors directly to your preferred wallet - no need for expensive service providers.

The plugin is the easiest and most flexible plugin to sell your digital content and to receive donations or Value 4 Value payments.
Using the Bitcoin Lightning Network you can create the best visitor experience with seamless one-click payments.


### Features

#### Paywall to sell content
Sell any digital content (pay-per-post, pay-per-view, pay-per-download, etc.) with a highly configurable paywall

* [WebLN enabled](https://www.webln.guide/) by default for easy on-click payments
* Add a paywall to posts and pages to easily charge for any published content
* Crowdfund option: make the content freely available after a certain amount is received
* Time-in option: keep the article freely available for a certain time and then enable the paywall after that
* Time-out option: make the article freely available after a certain time
* Configure the price in Satoshis, EUR, USD, or GBP (with real-time exchange rate)
* Configure the paywall with a shortcode (`[nlpaywall]`)
* Or configure the paywall with a Gutenberg Block
* Integrate with other tools and plugins like membership tools to control if the paywall should be enabled (see Paywall Hook section)


### REST-API for full advanced custom usage
For more advanced, custom Lightning integrations you can use the REST API to create and verify invoices. The API also provides a [LNURL-pay](https://github.com/fiatjaf/lnurl-rfc/blob/luds/06.md) endpoint. See the REST-API section for details.


## Requirements

* WordPress 5.6 or higher
* PHP 7.4 or higher (with [internationalization functions](https://www.php.net/manual/en/book.intl.php)

## Demo


## Installation

Install from the WordPress [Plugin directory](https://wordpress.org/plugins/) or:

Download the zip from the [latest release](https://github.com/nodeless-io/wordpress-paywall/releases/latest) and install/activate it through the WordPress Plugin admin panel.

To build the plugin yourself: clone the repository and install the dependency using [Composer](https://getcomposer.org/)

```bash
git clone https://github.com/nodeless-io/wordpress-paywall.git
cd wordpress-paywall
composer install # (maybe you need to add `--ignore-platform-reqs` if it asks you to update PHP)
```
To build a .zip file of the WordPress plugin run:
```bash
./build.sh # this builds a `nodeless-paywall.zip`
```

Then upload and activate the plugin through the WordPress Plugin admin panel.


## Paywall Hook to have custom logic when to enable/disable the paywall

To integrate with other plugins or to write custom conditions on when the paywall should be enabled a hook can be used. This means you can use a custom PHP function to decide if content should be behind the paywall or not.

This for example allows you to make the content available for all users/subscribers but enable the paywall for all other users.

##### Example

you can add such functions anywhere in your code. e.g. in `functions.php`

```php

// your function receives two arguments:
// 1. a boolean with the current check (true if the full content would be shown)
// 2. the ID of the post the user accesses
//
// return true if the full content should be shown or false to enable the paywall
function show_full_content_for_post($show_full_content, $post_id) {
  // Add your logic to check if the current user can see the post with ID $post_id

  // return true; // return true to show the full content (disable the paywall)

  // for example:
  // if the user has a subscription always show the full content.
  // otherwise let the plugin decide (e.g. show the full content if the user already had paid)
  if (user_has_a_subscription()) {
    return true;
  } else {
    return $show_full_content
  }
}

// Check out the `add_filter` documentation for more information: https://developer.wordpress.org/reference/functions/add_filter/
add_filter('wp_bln_has_paid_for_post', 'show_full_content_for_post', 10, 2);

```

Alternatively you can define a global function `wp_bln_has_paid_for_post` which gets called. Return `true` to disable the paywall and show the full content.

```php

function wp_bln_has_paid_for_post($show_full_content, $post_id) {
  return true; // show full content - disable the paywall
}

```

## Shortcode

If you do not use the Gutenberg editor you can use the `[nlpaywall]` shortcode. The content after the shortcode will be behind the paywall.
The following configuration options are possible:

* amount
* currency
* description
* button_text
* total
* timeout
* timein

#### Example

```
[nlpaywall amount=2121]
```

## Plugin folder structure

Folder structure is based on https://github.com/DevinVinson/WordPress-Plugin-Boilerplate

- `nodeless-paywall.php` is the entrypoint of the plugin
- `includes` is where functionality shared between the admin area and the public-facing parts of the site reside
- `admin` is for all admin-specific functionality
- `public` is for all public-facing functionality
- `includes/class-nodeless-paywall.php` is the main plugin class which handles including all the related classes.
- `includes/class-nodeless-paywall-loader.php` is responsible for registering the action and filter hooks, and shortcodes.

## REST API

The plugin also provides a set of REST API Endpoints for handling payments and donations.

#### Initiate Payment for Paywall

- URL: `/nlpw/v1/paywall/pay`
- Method: `POST`
- Auth Required: No
- Data example

```
{
    post_id: "xxx"
}
```

#### Verify Payment for Paywall

- URL: `/nlpw/v1/paywall/verify`
- Method: `POST`
- Auth Required: No
- Data example

```
{
    post_id: "xxx",
    token: "xxx",
    preimage: "xxx"
}
```

#### LNURL-pay

- URL: `/nlpw/v1/lnurlp`
- Method: `GET`
- Auth Required: No

```
{
    "status":"OK",
    "callback":"http:\/\/wp.play.getalby.com\/wp-json\/nlpw\/v1\/lnurlp\/callback",
    "minSendable":10000,
    "maxSendable":1000000000,
    "tag":"payRequest",
    "metadata":"[[\"text\/identifier\", \"http:\/\/wp.play.getalby.com\"][\"text\/plain\", \"Alby\"]]"
}
```

- URL: `/nlpw/v1/lnurlp/callback`
- Method: `GET`
- Auth Required: No

#### Initiate a general payment to generate an invoice

- URL: `/nlpw/v1/invoices`
- Method: `POST`
- Auth Required: No
- Data example

```
{
    amount: 123,
    currency: 'btc'
}
```

#### Verify Payment for an invoice

- URL: `/nlpw/v1/invoices/verify`
- Method: `POST`
- Auth Required: No
- Data example

```
{
    token: "xxx", // the token from the invoice creation enpoint
    preimage: "xxx"
}
```

## Get support

Do you need help? Create an issue or reach out to us: support[at]nodeless.io


## About Nodeless.io

This plugin is powered by [nodeless.io](https://nodeless.io/).

## License

GPL 3.0 (as WordPress)

## Credits

This is a fork of the brilliant [Bitcoin Lightning Publisher](https://github.com/getAlby/lightning-publisher-wordpress) plugin from [Alby](https://getalby.com).