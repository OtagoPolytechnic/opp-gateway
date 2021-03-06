import * as React from "react";
import { Form, Button, Modal, ControlLabel, FormControl, FormGroup, HelpBlock } from 'react-bootstrap';
import * as axios from 'axios';
import moment from 'moment';
import DateTime from 'react-datetime';
import Alert from './Alert';
import { env } from '../env';

export default class CreateEventModal extends React.Component {
    constructor(props) {
        super(props);

        let startTime = moment().startOf('hour');
        let endTime = moment(startTime).add(1, 'hour');

        this.state = {
            selectedCalendarId: -1,
            startedTypingTitle: false,
            eventTitle: '',
            place: '',
            startTime: startTime,
            endTime: endTime,
            errors: [],
        };
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            startTime: nextProps.startTime || this.state.startTime,
            endTime: nextProps.endTime || this.state.endTime,
        });
    }

    save() {
        this.setState({ startedTypingTitle: true });

        let errors = [];

        if (!this.titleIsValid()) {
            errors.push('Event title is required');
        }

        if (!this.endTimeIsValid()) {
            errors.push('End time must be after start time');
        }

        this.setState({ errors });

        if (errors.length == 0) {
            const calendarId = 1;

            axios.post(env.apiOrigin + '/v1/calendars/' + calendarId + '/events', {
                name: this.state.eventTitle,
                start_time: this.state.startTime,
                duration: 1,
                place: 'here'
            }).then((response) => {
                this.props.eventCreated()
                this.props.hide();
            });
        }
    }

    selectedCalendarChanged(e) {
        this.setState({ selectedCalendarId: e.target.value });
    }

    eventTitleChanged(e) {
        this.setState({
            startedTypingTitle: true,
            eventTitle: e.target.value
        });
    }

    placeChanged(e) {
        this.setState({ place: e.target.value });
    }

    startTimeChanged(newStartTime) {
        this.setState({ startTime: newStartTime });
    }

    endTimeChanged(newEndTime) {
        this.setState({ endTime: newEndTime });
    }

    hideErrors() {
        this.setState({ errors: '' });
    }

    titleIsValid() {
        return this.state.eventTitle.length > 0;
    }

    endTimeIsValid() {
        return this.state.endTime.isAfter(this.state.startTime);
    }

    render() {
        const titleValidationState = () => {
            if (!this.state.startedTypingTitle) {
                return null;
            }
            
            return this.titleIsValid() ? 'success' : 'error';
        }

        return (
            <Modal show={this.props.isVisible} onHide={() => this.props.hide()}>
                <Modal.Header closeButton>
                    <Modal.Title>
                        Add Event
                    </Modal.Title>
                </Modal.Header>

                <Modal.Body>
                    { !!this.state.errors.length &&
                        <Alert
                            heading='Error'
                            alertType='danger'
                            message={this.state.errors} />
                    }

                    <Form>
                        <FormGroup validationState='success'>
                            <ControlLabel>Calendar:</ControlLabel>
                            <FormControl
                                componentClass="select"
                                onChange={ this.selectedCalendarChanged.bind(this) }>
                                { this.props.calendars.map((calendar) => {
                                    return (
                                        <option value={ calendar.id } key={ calendar.id }>{ calendar.name }</option>
                                    );
                                })}
                            </FormControl>
                        </FormGroup>

                        <FormGroup validationState={titleValidationState()}>
                            <ControlLabel>Event title:</ControlLabel>
                            <small className='pull-right'>required</small>
                            <FormControl
                                type="text"
                                value={this.state.eventTitle}
                                placeholder="Event title"
                                onBlur={ () => { this.setState({ startedTypingTitle: true }); } }
                                onChange={this.eventTitleChanged.bind(this)} />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup validationState={this.state.place.length > 0 ? 'success' : null}>
                            <ControlLabel>Place:</ControlLabel>
                            <small className='pull-right'>optional</small>
                            <FormControl
                                type="text"
                                value={this.state.place}
                                placeholder="Place"
                                onChange={this.placeChanged.bind(this)} />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup validationState='success'>
                            <ControlLabel>Start time:</ControlLabel>
                            <small className='pull-right'>required</small>
                            <DateTime
                                locale='en-nz'
                                dateFormat='DD/MM/YYYY'
                                value={ this.state.startTime }
                                onChange={ this.startTimeChanged.bind(this) } />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup validationState={this.endTimeIsValid() ? 'success' : 'error'}>
                            <ControlLabel>End time:</ControlLabel>
                            <small className='pull-right'>required</small>
                            <DateTime
                                locale='en-nz'
                                dateFormat='DD/MM/YYYY'
                                value={ this.state.endTime }
                                onChange={ this.endTimeChanged.bind(this) } />
                            <FormControl.Feedback />
                        </FormGroup>
                    </Form>
                </Modal.Body>

                <Modal.Footer>
                    <Button onClick={() => this.props.hide()}>Close</Button>
                    <Button bsStyle='primary' onClick={this.save.bind(this)}>Save</Button>
                </Modal.Footer>
            </Modal>
        )
    }
}
