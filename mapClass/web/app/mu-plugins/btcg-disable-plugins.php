<?php
/**
 * Plugin Name: Disable Plugins
 * Description: Disables plugins based on the WP_ENV environment variable
 * Version: 1.0.0
 */

if (empty(getenv('WP_ENV')) || getenv('WP_ENV') != 'production') {
  $plugins = array(
    'btcg-follow-up-emails/woocommerce-follow-up-emails.php',
    'woocommerce-follow-up-emails/woocommerce-follow-up-emails.php',
    'the-events-calendar-eventbrite-tickets/tribe-eventbrite.php',
    'image-widget/image-widget.php',
    'linkedin-sc/linkedin-sc.php',
    'page-links-to/page-links-to.php',
    'w3-total-cache/w3-total-cache.php',
    'wp-testimonials/wp-testimonials.php',
    'better-wp-security/better-wp-security.php'
  );
  require_once(ABSPATH . 'wp-admin/includes/plugin.php');
  deactivate_plugins($plugins);
}