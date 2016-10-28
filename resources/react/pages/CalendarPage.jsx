import React from 'react';
import Calendar from '../components/Calendar';
import AddEvent from '../components/AddEvent';
import axios from 'axios';
import { Button } from 'react-bootstrap';

export default class CalendarPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            'events': [],
            'calendars': [],
            showCreateEventModal: false
        }
    }

    componentDidMount() {
        this.fetchEvents(1);
        this.fetchCalendars(1);
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

    fetchCalendars(userId) {
        axios.get('http://api.gateway.dev/v1/users/' + userId + '/calendars')
            .then((response) => {
                let calendars = [];
                let data = response.data.data.calendars;

                data.map((calendar) =>{
                    calendars.push({
                        name: calendar.name,
                        colour: calendar.colour,
                        ownedByUser: calendar.owned_by_user
                    })
                });

                this.setState({ calendars });
             });
    }

    toggleCreateEventModal(visible) {
        this.setState({ showCreateEventModal: visible });
    }
    
    render() {
        return (
            <div>
                <Button bsStyle='primary' onClick={() => { this.toggleCreateEventModal(true) }}>
                    Create Event
                </Button>

                <AddEvent 
                    isVisible={this.state.showCreateEventModal}
                    hide={() => { this.toggleCreateEventModal(false) }}
                    calendars={this.state.calendars} />

                <div className="main-content">
                    <Calendar events={this.state.events} />
                </div>
            </div>
        );
    }
}
