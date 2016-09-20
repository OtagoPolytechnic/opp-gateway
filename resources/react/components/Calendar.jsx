import React, { PropTypes } from 'react';

export default React.createClass({
    getInitialState() {
        return {
            'events': []
        };
    },

    componentDidMount() {
        this.fetchEventsRequest = this.fetchEvents(1);
    },

    componentWillUnmount() {
        this.fetchEventsRequest.abort();
        const { calendar } = this.refs;

        $(calendar).fullCalendar('destroy');
    },

    fetchEvents: function(userId) {
        $.ajax({
            url: 'http://api.gateway.dev/v1/users/' + userId + '/events',
            success: (data) => {
                let events = [];
                data = data['data']['events'];
                
                data.map((event) =>
                {
                    let start = new moment(event['start_time']);
                    let duration = event['duration'];
                    let end = start.add(duration, 'minutes');

                    events.push(
                        {
                            title: event['event_name'],
                            start: start.toDate(),
                            end: end.toDate(),
                            color: '#' + event['colour']
                        }
                    )
                });

                this.setState({ events });
            }
        }).then(() =>{
            const { calendar } = this.refs;

            $(calendar).fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: this.state.events
            });
        });
    },

    render(){
        return (
            <div ref='calendar'></div>
        );
    }
});
