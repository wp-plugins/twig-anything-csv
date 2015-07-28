=== Twig Anything CSV ===
Contributors: meglio
Tags: csv, comma separate values, excel, twig
Requires at least: 3.6.1
Tested up to: 4.2.3
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds CSV support (comma-separated values) to the Twig Anything plugin. The delimiter, enclosure and escape characters are configurable.




== Description ==

Adds CSV (comma-separated values) parsing to the
[Twig Anything](https://twiganything.com/ "Twig Anything") WordPress plugin.

= How to use =

Let us use a CSV file with a list of country names and their corresponding top-level domain names (TLD). Here is an extract from the file:

`Belgium,Brussels,EUR,Euro,BE,.be
Belize,Belmopan,BZD,Dollar,BZ,.bz
Benin,Porto-Novo,XOF,Franc,BJ,.bj
Bhutan,Thimphu,BTN,Ngultrum,BT,.bt`

We want to display TLDs for all countries that start with “D”, just like this:

`Denmark - .dk
Djibouti - .dj
Dominica - .dm
Dominican Republic - .do`

Because columns are numbered starting from #0, we will need the column #0 (country name) and #5 (top-level domain name).

After the input is parsed, the resulting sequence of lines is passed to your Twig template as the data variable. You can then loop over it with using Twig’s [“for” syntax:](http://twig.sensiolabs.org/doc/tags/for.html):

`{% for row in data if row.0|slice(0,1)|upper == 'D' %}
  {{ row.0 }} - <strong>{{row.5}}</strong><br/>
{% endfor %}`

`{% for row in data %}...{% endfor %}` is the loop. The code inside the loop will be rendered once for every line from the CSV file.

Let us take a closer look at this piece: `if row.0|slice(0,1)|upper == 'D'`

First of all, `row.0` is how we access column #0, a country name in our case. Next, `|slice(0,1)` is a Twig filter that takes the first character of the country name. The next filter is `|upper` and it simply uppercases the first letter returned by the previous filter. Finally, we only allow for countries that start with the “D” letter: `== 'D'`.

Inside the loop, we output a country name with using `{{row.0}}` and a TLD name with using `{{row.5}}`. Plus a very basic HTML markup: `<br/>` to insert a line break and `<strong>...</strong>` to make TLD name appear bold.


== Installation ==

= Minimum Requirements =

* WordPress 3.6.1 or greater
* PHP version 5.4 or greater
* MySQL version 5.0 or greater
* [Twig Anything](https://twiganything.com) WordPress plugin version 1.3 or greater

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don’t need to leave your web browser. To do an automatic install of Twig Anything CSV, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type “Twig Anything CSV” and click Search Plugins. Once you’ve found the plugin, you can view details about it such as the the point release, rating and description. Most importantly, of course, you can install it by simply clicking “Install Now”.

= Manual installation =

The manual installation method involves downloading our CSV (comma separated values) format plugin and uploading it to your webserver via your favourite FTP application. The WordPress codex contains [instructions on how to do this here](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

= Updating =

Automatic updates should work like a charm; as always though, ensure you backup your site just in case.

1. Upload `twig-anything-csv.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress




== Frequently Asked Questions ==

= From where can it fetch CSV data? =

Because this is an add-on for the
[Twig Anything](https://twiganything.com) WordPress plugin,
it can fetch your CSV input from various sources: a local file,
a URL, a MySQL database (out of the box) and many more
with custom data source add-ons.


= Can I configure the field delimiter character? =

**Yes**, you can specify any delimiter character (one character only).

If you want to use `TAB` as the delimiter, input `\t`
in the *Delimiter Character* setting.

By default, the delimiter character is set to a comma "**,**".


= Can I configure the enclosure character? =

**Yes**, you can specify any enclosure character (one character only).

By default, its value is double-quotes **"**


= Can I configure the field escape character? =

**Yes**, you can specify any escape character (one character only).

By default, its value is a backslash "**\\**"


= How to loop through the parsed CSV lines =

In your Twig Anything template, use the Twig's ["for" syntax](http://twig.sensiolabs.org/doc/tags/for.html).
For example:

`{% for row in data %}
  Text in the first column: {{row.0}},
  Text in the third column: {{row.2}} <br/>
{% endfor %}`

Note that the the sequence of all CSV lines is always passed to your template as **data** variable
and in the same order as it appears in the parsed data source (e.g. a .csv file).


= How to access individual columns =

Columns are indexed starting from 0, so to access the content of the first column,
use `{{row.0}}`; for the second column, use `{{row.1}}` and so forth. 


= How to filter CSV rows by a particular column =

Add [a condition](http://twig.sensiolabs.org/doc/tags/for.html#adding-a-condition) to your loop.
For example, if a country name is stored in the second column (column #1),
 and you want to only show entries where the country name starts with D: 

`{% for row in data if row.1|slice(0,1)|upper == 'D' %}
  {{ row.1 }}<br/>
{% endfor %}`

In this example, `|slice(0,1)` is a filter that extracts the first letter; `|upper` is another filter that uppercases that letter. Finally, we only output what is inside the loop if the letter is **D**: `if row.1|slice(0,1)|upper == 'D'`.

= How does it parse my CSV? =

Internally, the [`str-getcsv()`](http://php.net/manual/en/function.str-getcsv.php)
PHP function is used. It parses a CSV string into an array. A sequence
of such arrays is then passed to your template as the `data` variable,
so you can loop over it.




== Screenshots ==

1. The slick Data Source settings panel with CSV format selected and custom format configuration fields: Delimiter character, Enclosure character and Escape character.
2. An example of CSV format in action: a CSV file with country names and their corresponding top-level domain names is parsed, and then only countries that start with "D" are displayed. 
3. A Twig Template that uses CSV data and outputs an example shown on the previous screenshot. 




== Changelog ==

= 1.0 =
* The first release
