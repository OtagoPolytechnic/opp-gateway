import React, { PropTypes } from 'react';

export default React.createClass({
    getInitialState() {
        return {
            'events': []
        };
    },

    componentWillUnmount() {
        const { calendar } = this.refs;

        $(calendar).fullCalendar('destroy');
    },

    componentDidUpdate() {
        const { calendar } = this.refs;

        $(calendar).fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: this.props.events,
            selectable: true,
            select: this.props.rangeSelected
        });
    },

    render(){
        return (
            <div>
                <div ref='calendar'></div>
            </div>
        );
    }
});
