<?php
/**
 * Flatsome functions and definitions
 *
 * @package flatsome
 */

set_transient( 'flatsome_purchase_code', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', 120 );
set_transient( 'flatsome_purchase_id', 99, 120 );
set_transient( 'flatsome_registration_confirmed', 1, 120 );
$license = [
    'type'         => 'PUBLIC',
    'domain'       => wp_parse_url(get_site_url(), PHP_URL_HOST),
    'registeredAt' => time(),
    'purchaseCode' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
    'licenseType'  => 'Regular',
];
update_option('flatsome_registration', $license);
add_filter('pre_http_request', function ($preempt, $args, $url) {
    if (strpos($url, 'api.uxthemes.com') !== false) {
        return new WP_Error('http_blocked', 'Blocked request to UXThemes API.');
    }
    return $preempt;
}, 10, 3);

require get_template_directory() . '/inc/init.php';

flatsome()->init();

/**
 * It's not recommended to add any custom code here. Please use a child theme
 * so that your customizations aren't lost during updates.
 *
 * Learn more here: https://developer.wordpress.org/themes/advanced-topics/child-themes/
 */
