import React from 'react';
import Calendar from '../components/Calendar';
import 'whatwg-fetch';

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
        });
    },
    
    render() {
        return (
            <div>
                <div className="page-header">
                    Calendar
                </div>

                <div className="main-content">
                    <Calendar events={this.state.events} />
                </div>
            </div>
        );
    }
});
