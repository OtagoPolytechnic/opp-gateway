import React, { PropTypes } from 'react';

export default class Calendar extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            events: []
        }
    }

    componentWillUnmount() {
        const { calendar } = this.refs;
    }

    componentDidUpdate(prevProps, prevState) {
        const { calendar } = this.refs;

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
    }

    render() {
        return (
            <div>
                <div ref='calendar'></div>
            </div>
        );
    }
}
