import React from 'react';
import Calendar from '../components/Calendar';
import axios from 'axios';

export default class CalendarPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            'events': []
        }
    }

    componentDidMount() {
        this.fetchEvents(1);
    }

    fetchEvents(userId) {
        axios.get('http://api.gateway.dev/v1/users/' + userId + '/events')
            .then((response) => {
                let events = [];
                let data = response.data.data.events;

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
             });
    }
    
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
}
