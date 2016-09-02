import React, { PropTypes } from 'react';

export default React.createClass({

    componentDidMount() {
        const { calendar } = this.refs;

        $(calendar).fullCalendar({
            events: this.props.events
        });
    },

    componentWillUnmount() {
        const { calendar } = this.refs;

        $(calendar).fullCalendar('destroy');
    },

    render(){
        return (
            <div ref='calendar'></div>
        );
    }
});
