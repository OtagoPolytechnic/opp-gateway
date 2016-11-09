import React from 'react';
import Calendar from '../components/Calendar';
import CreateEventModal from '../components/CreateEventModal';
import NewCalendarModal from '../components/NewCalendarModal';
import axios from 'axios';
import { Button, Row, Col } from 'react-bootstrap';
import { env } from '../env';

export default class CalendarPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            events: [],
            ownedCalendars: [],
            subscribedCalendars: [],
            showCreateEventModal: false,
            showNewCalendarModal: false,
            createStartTime: null,
            createEndTime: null
        }
    }

    componentDidMount() {
        this.fetchEvents(1);
        this.fetchCalendars(1);
    }

    fetchEvents(userId) {
        axios.get(env.apiOrigin + '/v1/users/' + userId + '/events').then((response) => {
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
        axios.get(env.apiOrigin + '/v1/users/' + userId + '/calendars').then((response) => {
            let ownedCalendars = [];
            let subscribedCalendars = [];
            let data = response.data.data.calendars;

            data.map((calendar) =>{
                let newCalendar = {
                    id: calendar.id,
                    name: calendar.name,
                    colour: calendar.colour,
                    ownedByUser: calendar.owned_by_user
                }

                if (calendar.owned_by_user) {
                    ownedCalendars.push(newCalendar);
                } else {
                    subscribedCalendars.push(newCalendar);
                }
            });

        this.setState({ ownedCalendars, subscribedCalendars });
        });
    }

    toggleCreateEventModal(visible) {
        this.setState({ showCreateEventModal: visible });
    }

    toggleNewCalendarModal(visible) {
        this.setState({ showNewCalendarModal: visible });
    }

    calendarRangeSelected(start, end) {
        this.setState({
            createStartTime: start,
            createEndTime: end
        });

        this.toggleCreateEventModal(true);
    }

    eventCreated() {
        this.fetchEvents(1);
    }

    calendarCreated() {
        this.fetchCalendars(1);
    }
    
    render() {
        return (
            <div className="main-content">
                <Row>
                    <Col md={4} lg={3}>
                        <Button
                            bsStyle='primary'
                            block={ true }
                            className='margin-bottom-30' 
                            onClick={() => { this.toggleCreateEventModal(true) }}>
                            Create Event
                        </Button>

                        <div className='panel panel-primary calendar-list'>
                            <div className='panel-heading'>Calendars</div>
                            <div className='panel-body'>
                                <h4>Your calendars:</h4>
                                <ul>
                                    {
                                        this.state.ownedCalendars.map((calendar, index) => {
                                            return <li key={ index }>{ calendar.name }</li>
                                        })
                                    }
                                </ul>
                                <a onClick={ () => this.toggleNewCalendarModal(true) }>+ New calendar</a>
                                <hr />
                                <h4>Subscribed to:</h4>
                                <ul>
                                    {
                                        this.state.subscribedCalendars.map((calendar, index) => {
                                            return <li key={ index }>{ calendar.name }</li>
                                        })
                                    }
                                </ul>
                            </div>
                        </div>
                    </Col>

                    <Col md={8} lg={9}>
                        <Calendar
                            events={ this.state.events }
                            rangeSelected={ this.calendarRangeSelected.bind(this) } />
                    </Col>
                </Row>

                <CreateEventModal 
                    isVisible={ this.state.showCreateEventModal }
                    hide={() => { this.toggleCreateEventModal(false) }}
                    eventCreated={ this.eventCreated.bind(this) }
                    calendars={ this.state.ownedCalendars }
                    startTime={ this.state.createStartTime || null } 
                    endTime={ this.state.createEndTime || null } />

                <NewCalendarModal 
                    isVisible={ this.state.showNewCalendarModal }
                    calendarCreated={ this.calendarCreated.bind(this) }
                    hide={() => { this.toggleNewCalendarModal(false) }} />
            </div>
        );
    }
}
