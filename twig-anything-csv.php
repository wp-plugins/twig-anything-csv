<?php
/*
Plugin Name: CSV Format
Plugin URI:  https://twiganything.com/csv-format
Description: Adds CSV support (comma-separated values) to the Twig Anything plugin. The delimiter, enclosure and escape characters are configurable.
Version:     1.1
Author:      Anton Andriievskyi
Author URI:  https://twiganything.com/author
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: twig-anything-csv
*/

namespace TwigAnythingCsvFormat;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action('twig_anything_register_custom_formats', function($formats) {
    /** @var \TwigAnything\Formats\FormatsRegister $formats */
    if (!is_object($formats) || get_class($formats) !== 'TwigAnything\Formats\FormatsRegister') {
        return;
    }
    require_once __DIR__.'/TwigAnythingCSV.php';
    $formats->register(new TwigAnythingCSV);
});

add_action('admin_notices', function() {
    $screen = get_current_screen();
    if ($screen->id == 'plugins' && !is_plugin_active('twig-anything/twig-anything.php')) {
        echo '<div class="error"><p>';
        _e('Plugin <strong>CSV Format</strong> is an add-on for <a href="https://twiganything.com" target="_blank">Twig Anything</a> plugin - please install and activate that first.', 'twig-anything-csv');
        echo '</p></div>';
    }
});

add_filter('plugin_action_links_' . plugin_basename(__FILE__), function($links) {
    $links[] = '<a href="http://forum.twiganything.com" target="_blank">Support and community</a>';
    return $links;
});