=== CSV Format ===
Contributors: meglio
Tags: csv, comma separated values, excel, comma-separated, csv api, delimiter, delimiter character, escape character, enclosure character, parse csv, output csv, read csv, read csv, csv file, csv from file, csv to api, parse csv, import csv, understand csv, csv style, csv values, csv format, csv lines, interpret csv, local csv, big csv, cache csv, export from excel, read excel, csv template, twig, twig template, twig anything
Requires at least: 3.6.1
Tested up to: 4.2.4
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Read and output any CSV data in WordPress: filter, sort, output in tables, lists or any HTML.



== Description ==

Read CSV data from local files, WordPres media files, local or remote databases or 3rd party API, and output it anywhere in WordPress with using shortcodes, in posts/pages, headers/footers, widgets or in Visual Composer.

You can configure how CSV is parsed by specifying delimiter character, enclosure character and escape character.

*This is a free add-on that adds CSV support (comma-separated values) to the
[Twig Anything](https://twiganything.com/ "Twig Anything") WordPress plugin.*

Tutorials below demonstrate 3 examples:

* Example 1: generate text, one line for each line from CSV
* Example 2: generate a table
* Example 3: use shortcodes to output CSV anywhere in WordPress


= EXAMPLE 1: MULTILINE TEXT =

Let us use a CSV file with a list of countries and their corresponding top-level domain names (TLD). Here is an extract from the file:

`Belgium,Brussels,EUR,Euro,BE,.be
Belize,Belmopan,BZD,Dollar,BZ,.bz
Benin,Porto-Novo,XOF,Franc,BJ,.bj
Bhutan,Thimphu,BTN,Ngultrum,BT,.bt`

In our example, let's display TLDs for all countries that start with “D”:

`Denmark - .dk
Djibouti - .dj
Dominica - .dm
Dominican Republic - .do`

Columns are numbered starting from #0, so we will need the column #0 (country name) and #5 (top-level domain name).

After the CSV input has been parsed, the resulting lines are passed to your Twig Template as the **data** variable. You can then loop over it with using [“for” syntax:](http://twig.sensiolabs.org/doc/tags/for.html):

`{% for row in data if row.0|slice(0,1)|upper == 'D' %}
  {{ row.0 }} - <strong>{{row.5}}</strong><br/>
{% endfor %}`

`{% for row in data %}...{% endfor %}` is the loop. The code inside the loop will be rendered once for every line from the CSV file.

Let us take a closer look at this piece: `if row.0|slice(0,1)|upper == 'D'`

First of all, `row.0` is how we access column #0, a country name in our case. Next, `|slice(0,1)` is a Twig filter that takes the first character of the country name. The next filter is `|upper` and it simply uppercases the first letter returned by the previous filter. Finally, we only allow for countries that start with the “D” letter: `== 'D'`.

Inside the loop, we output a country name with using `{{row.0}}` and a TLD name with using `{{row.5}}`. Plus a very basic HTML markup: `<br/>` to insert a line break and `<strong>...</strong>` to make TLD name appear bold.


= EXAMPLE 2: TABLE =

Using the same CSV file, let's now output our data in a table with using HTML markup.

If you are not very familiar with HTML, I recommend going through the following tutorials - you'll learn in 10 minutes, I guarantee!

* [Tutorial 1](https://computerservices.temple.edu/creating-tables-html)
* [Tutorial 2](https://css-tricks.com/complete-guide-table-element/)

You can also use the following table generators and just copy-paste the HTML they generate right into your template. The generators also allow to apply some basic styling, like borders, colors, margins, paddings etc. 

* [Generator 1](http://www.rapidtables.com/web/tools/html-table-generator.htm)
* [Generator 2](http://www.textfixer.com/html/html-table-generator.php)

So, we will use the following HTML tags:

* `<table>...</table>` to make a table
* `<thead>...</thead>` to make a table header with column headings
* `<tbody>...</tbody>` to make a table body with all the rows from CSV
* `<tr>...</tr>` to make a table row
* `<th>...</th>` to make a cell in the header's row
* `<td>...</td>` to make a cell in a regular rows in the table's body

Here is our template:

`<table>
  <thead>
    <tr>
      <th>Country</th>
      <th>TLD</th>
    </tr>
  </thead>
  <tbody>
  {% for row in data if row.0|slice(0,1)|upper == 'D' %}
  <tr>
    <td>{{ row.0 }}</td>
    <td>{{ row.5 }}</td>
  </tr>
  {% endfor %}
  </tbody>
</table>`

Notice how we use the `{% for row in data %}` syntax to loop over CSV lines,
and then output a table row `<tr>...</tr>` inside the loop, so that
a new row is made for every CSV line.

Actually, you can use just any HTML and stylize your table the way you need.
Just don't forget to put `{{row.0}}`, `{{row.1}}` etc where you want
your csv values in the cells `<td>...</td>`.


= EXAMPLE 3: SHORTCODES =

While you prepare your template, you usually preview it many times by clicking
the "Preview Changes" button. Once you are happy with the preview, you will
want to embed it somewhere - in a post or a page, footer / header,
in a widget or as a Visual Composer block.

To embed your template, you will use a shortcode:

`[twig-anything slug="my-template-slug"]`

In WordPress, every Twig Template has its own slug, just like posts and pages.
It can be found under the template title.

Alternatively, you can use the template ID:
 
`[twig-anything id="123"]`




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

= 1.1=
* Add link to Community and Support forum to the Plugins list page
* Check if Twig Anything is installed and active, show a notice if it is not

= 1.0 =
* The first release




== Upgrade Notice ==

= 1.1 =
This version adds a link to Community and Support forum for your convenience. It also checks if Twig Anything plugin is active and installed, and shows a notice if it is not. This is not a critical update.
