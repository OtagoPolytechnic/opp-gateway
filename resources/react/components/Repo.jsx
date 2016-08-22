import React from 'react';

export default React.createClass({
    render() {
        return (
            <li className="list-group-item">
                <a href={this.props.url}>
                    {this.props.title}
                </a>
            </li>
        );
    }
});
