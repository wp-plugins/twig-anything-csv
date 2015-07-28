<?php
/*
Plugin Name: CSV format for Twig Anything
Plugin URI:  https://twiganything.com/csv-format
Description: Adds CSV support (comma-separated values) to the Twig Anything plugin. The delimiter, enclosure and escape characters are configurable.
Version:     1.0
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