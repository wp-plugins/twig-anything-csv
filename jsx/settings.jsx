var TwigAnythingFormat_twig_anything_csv = React.createClass({
    getInitialState: function() {
        return {
            delimiter_char: ',',
            enclosure_char: '"',
            escape_char: '\\'
        }
    },
    getSettings: function() {
        return {
            delimiter_char: this.state.delimiter_char,
            enclosure_char: this.state.enclosure_char,
            escape_char: this.state.escape_char
        }
    },
    handleDelimiterChange: function(e) {
        this.setState({delimiter_char: e.target.value});
    },
    handleEnclosureChange: function(e) {
        this.setState({enclosure_char: e.target.value});
    },
    handleEscapeChange: function(e) {
        this.setState({escape_char: e.target.value});
    },
    render: function() {
        return (
            <table className="form-table">
                <tbody>

                {/* DELIMITER CHARACTER */}
                <tr>

                    <th scope="row">
                        <label for="twig_anything_format_delimiter_char">Delimiter character</label>
                    </th>
                    <td>
                        <input
                            name     = "twig_anything_format_delimiter_char"
                            id       = "twig_anything_format_delimiter_char"
                            value    = {this.state.delimiter_char}
                            onChange = {this.handleDelimiterChange}
                            maxLength = {2} />

                        <p className="description">
                            The field delimiter (one character only).
                            Use <code>\t</code> for <code>TAB</code> symbol
                        </p>
                    </td>
                </tr>

                {/* ENCLOSURE CHARACTER */}
                <tr>
                    <th scope="row">
                        <label for="twig_anything_format_enclosure_char">Enclosure character</label>
                    </th>
                    <td>
                        <input
                            name      = "twig_anything_format_enclosure_char"
                            id        = "twig_anything_format_enclosure_char"
                            value     = {this.state.enclosure_char}
                            onChange  = {this.handleEnclosureChange}
                            maxLength = {1} />

                        <p className="description">
                            The field enclosure character (one character only)
                        </p>
                    </td>
                </tr>

                {/* ENCLOSURE CHARACTER */}
                <tr>
                    <th scope="row">
                        <label for="twig_anything_format_escape_char">Escape character</label>
                    </th>
                    <td>
                        <input
                            name      = "twig_anything_format_escape_char"
                            id        = "twig_anything_format_escape_char"
                            value     = {this.state.escape_char}
                            onChange  = {this.handleEscapeChange}
                            maxLength = {1} />

                        <p className="description">
                            The escape character (one character only)
                        </p>
                    </td>
                </tr>

                </tbody>
            </table>
        )
    }
});