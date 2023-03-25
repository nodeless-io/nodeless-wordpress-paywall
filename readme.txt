=== Nodeless Paywall ===

Tags: bitcoin, lightning, payment, donation, paywall, rss, micropayments
Requires at least: 5.6.0
Tested up to: 6.1.1
Requires PHP: 8.0
Stable tag: 1.0.5
License: GPLv3
Contributors: nodeless,ndeet


== Description ==
Nodeless Paywall is a Paywall plugin for WordPress to accept instant Bitcoin Lightning payments.

It allows you to monetize any digital content with instant microtransactions over the Bitcoin Lightning Network and receive payments from your visitors.

The plugin is the easiest and most flexible plugin to sell your digital content on your WordPress site. Using the Bitcoin Lightning Network you can create the best visitor experience with seamless one-click payments.

**Benefits for you, the publisher:**
- Monetize any digital content with instant microtransactions
- Best and fast checkout payment experience
- Superior paywall user experience
- Receive payments directly in your lightning address or cold storage

**Benefits for your vistors/customers:**
- Seamless one-click payments and quick access to the content
- Global availability - let customers from around the world send you payments through the open Bitcoin payment network


**Use Case Examples:**
- Monetize any digital content on your website: Articles, pages, file, videos, music, podcasts
- Integrate payments with your website functionality
- many more


== Features ==

=== Paywall to sell content ===

Sell any digital content (pay-per-post, pay-per-view, pay-per-download, etc.) with a highly configurable paywall

* WebLN enabled by default for easy on-click payments
* Add a paywall to posts and pages to easily charge for any published content
* Crowdfund option: make the content freely available after a certain amount is received
* Time-in option: keep the article freely available for a certain time and then enable the paywall after that
* Time-out option: make the article freely available after a certain time
* Configure the price in Sats (Satoshis), EUR, USD, or GBP (with real-time exchange rate)
* Configure the paywall with a shortcode ([nlpaywall])
* Or configure the paywall with a Gutenberg Block
* Integrate with other tools and plugins like membership tools to control if the paywall should be enabled (see Paywall Hook section)


=== REST-API for full advanced custom usage ===

For more advanced, custom Lightning integrations you can use the REST API to create and verify invoices. See the REST-API section for details.

== Changelog ==
[Release notes on GitHub](https://github.com/nodeless-io/wordpress-paywall/releases)

== Upgrade Notice ==
= 1.0.5 :: 2023-03-25 =
* Fix: update to latest nodeless PHP library

= 1.0.4 :: 2023-03-25 =
* Fix build action, add composer.lock

= 1.0.3 :: 2023-03-25 =
* Fix build action, remove unsupported build step

= 1.0.2 :: 2023-03-25 =
* Fix build action, missing gmp dependency

= 1.0.1 :: 2023-03-25 =
* Replace connection check with API status check.

= 1.0.0 :: 2023-03-15 =
Initial release

== Additional Info ==
**Contributing**
This plugin is free and open source. We welcome and appreciate new contributions.
Visit the [code repository](https://github.com/nodeless-io/wordpress-paywall) and help us to improve the plugin.

**Credits**
This plugin is a fork of the [Bitcoin Lightning Publisher plugin](https://wordpress.org/plugins/bitcoin-lightning-publisher/) from [Alby](https://getalby.com) but adjusted to be used with the Nodeless.io service.
