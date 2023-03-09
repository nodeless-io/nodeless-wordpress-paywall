<?php

// If this file is called directly, abort.
defined('WPINC') || die; ?>

<div class="wrap lnp">
    <h1><?php echo esc_html($this->get_page_title()); ?></h1>

    <h2>Getting Started</h2>
    <p>How to get started receiving lightning payments with your WordPress page</p>

    <ol>
        <li>
            <strong>Configure your Nodeless wallet</strong>:
            Go to <i>Connection Settings</i> and configure your existing Wallet connection.<br>
        </li>
        <li>
            <strong>Configure your paywall defaults</strong>:
            Go to <i>Paywall Settings</i> to configure your default settings. Those can always be overwritten on an individual post level but defaults make it easy.
        </li>
        <li>
            <strong>Done</strong>:
            Add the paywall blocks to your posts using the Gutenberg Block editor or use the <i>[nlpaywall]</i> shortcode.<br>
        </li>
    </ol>

    <hr>

    <h2>Getting Help</h2>
    <p>If you need help please reach out to support@nodeless.io</p>
    <p>For more details please visit the <a href="https://github.com/nodeless-io/wordpress-paywall">GitHub repository</a>.</p>

    <hr>

    <h2>Shortcodes</h2>

    <h3>Paywall</h3>
    <p>
        Use the [nlpaywall] shortcode to add and configure a paywall to your post. Any content after the [nlpaywall] shortcode will be behind the paywall and only accessible to the user after a payment.
    </p>
    <p>
        Configure the paywall defaults in the <i>Paywall Settings</i> or overwrite the defaults with the following options: <code>amount</code>, <code>currency</code>, <code>button_text</code>, <code>total</code>, <code>timein</code>, <code>timeout</code>
    </p>
    <p>Examples:</p>
    <p><code>[nlpaywall amount="100"]</code> (100 sats)</p>
    <p><code>[nlpaywall amount="100" currency="eur"]</code> (100 EUR cents (1.00 EUR))</p>
    <p><code>[nlpaywall button_text="Support our work"]</code> (100 EUR cents (1.00 EUR))</p>

    <hr>

    <h2>Paywall Settings</h2>
    <p>
        The advanced Paywall Settings allow you to activate the paywall with certain options:
    </p>
    <ul style="list-style:disc">
        <li>
            <strong>Timeout</strong>: Option to determine the number of hours you want to keep the article behind a paywall before making it free.
        </li>
        <li>
            <strong>Timein</strong>: Option to determine the number of hours you want to keep the article free before triggering the paywall.
        </li>
        <li>
            <strong>Total</strong>: Crowdfund the amount of funds you want to receive and disable the paywall after the desired funds are collected.
        </li>
        <li>
            <strong>Disable Paywall in RSS feeds</strong>: Show the full content in RSS feeds.
        </li>
    </ul>

    <h2>Connection Settings</h2>
    <p>
        Configure your Nodeless account by entering your Nodeless API token.
    </p>

    <h2>General Settings</h2>
    <ul style="list-style:disc">
        <li>Cookie timeframe: you can override the default of 180 days of how long the cookies are valid and the content stays accessible.</li>
    </ul>

</div>
