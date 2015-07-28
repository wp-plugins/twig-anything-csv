<?php

namespace TwigAnythingCsvFormat;

use TwigAnything\Formats\FormatConfigurationException;
use TwigAnything\Formats\FormatInterface;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class TwigAnythingCSV implements FormatInterface
{
    public static function pluginDir() {
        return __DIR__;
    }

    public static function pluginFile() {
        return self::pluginDir() . '/twig-anything-csv.php';
    }

    public function getSlug() {
        return 'twig_anything_csv';
    }

    public function getVersion() {
        return '1';
    }

    public function getShortName() {
        return 'CSV';
    }

    public function getLongName() {
        return __('CSV - comma-separated values', 'twig-anything-csv');
    }

    public function getDescription() {
        return __('Parse retrieved data as a CSV-text', 'twig-anything-csv');
    }

    public function getDefaultConfig() {
        return [
            'delimiter_char' => ',',
            'enclosure_char' => '"',
            'escape_char'    => "\\",
        ];
    }
    public function getUrlToComponentJs() {
        return plugins_url('jsx/settings.js', self::pluginFile());
    }

    public function parseFromDataSource($config, $retrievedData) {
        if (!is_string($retrievedData)) {
            $retrievedData = (string) $retrievedData;
        }

        $delimiter = array_key_exists('delimiter_char', $config)? $config['delimiter_char'] : null;
        if (!is_scalar($delimiter)) {
            throw new FormatConfigurationException(__("CSV delimiter is not a scalar value.", 'twig-anything-csv'));
        }
        if ($delimiter === '\\t') {
            $delimiter = "\t";
        }
        if (strlen($delimiter) !== 1) {
            throw new FormatConfigurationException(__("CSV delimiter must be one character exactly.", 'twig-anything-csv'));
        }

        $enclosure = array_key_exists('enclosure_char', $config)? $config['enclosure_char'] : null;
        if (!is_scalar($enclosure)) {
            throw new FormatConfigurationException(__("CSV enclosure character is not a scalar value.", 'twig-anything-csv'));
        }
        if (strlen($enclosure) !== 1) {
            throw new FormatConfigurationException(__("CSV enclosure character must be one character exactly.", 'twig-anything-csv'));
        }

        $escape = array_key_exists('escape_char', $config)? $config['escape_char'] : null;
        if (!is_scalar($escape)) {
            throw new FormatConfigurationException(__("CSV escape character is not a scalar value.", 'twig-anything-csv'));
        }
        if (strlen($escape) !== 1) {
            throw new FormatConfigurationException(__("CSV escape character must be one character exactly.", 'twig-anything-csv'));
        }

        $array = preg_split("/\r\n|\n|\r/", $retrievedData, -1, PREG_SPLIT_NO_EMPTY);
        foreach($array as &$row) {
            $row = str_getcsv($row, $delimiter, $enclosure, $escape);
        }

        return $array;
    }

    public function serializeForCache($data) {
        // Parsed CSV data is always an array, so we can cache it as is
        return $data;
    }

    public function deserializeFromCache($cachedValue) {
        // Cached data is already an array, so we don't need to apply any conversion
        return $cachedValue;
    }
}