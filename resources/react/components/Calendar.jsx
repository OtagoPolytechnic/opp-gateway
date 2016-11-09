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

    componentDidUpdate(prevProps, prevState) {
        const { calendar } = this.refs;

        console.log(this.props.events);

        $(calendar).fullCalendar('destroy');

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
