import * as React from "react";
import { Form, Button, Modal, ControlLabel, FormControl, FormGroup, HelpBlock, InputGroup } from 'react-bootstrap';
import * as axios from 'axios';
import Alert from './Alert';
import { GithubPicker } from 'react-color';

export default class NewCalendarModal extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            validateName: false,
            name: '',
            colour: '337ab7',
            errors: [],
        };
    }

    save() {
        this.setState({ startedTypingTitle: true });

        let errors = [];

        if (!this.nameIsValid()) {
            errors.push('Calendar name is required');
        }

        if (!this.colourIsValid()) {
            errors.push('Colour must be a legal HEX colour');
        }

        this.setState({ errors });

        if (errors.length == 0) {
            const userId = 1;
            
            axios.post('http://api.gateway.dev/v1/users/' + userId + '/calendars', {
                name: this.state.name,
                colour: this.state.colour
            }).then((response) => {
                this.props.calendarCreated();
                this.props.hide();
            });
        }
    }

    nameChanged(e) {
        this.setState({
            validateName: true,
            name: e.target.value
        });
    }

    colourChanged(e) {
        this.setState({ colour: e.target.value });
    }

    nameIsValid() {
        return this.state.name.length > 0;
    }

    colourIsValid() {
        return /^([0-9a-f]{3}){1,2}$/i.test(this.state.colour);
    }

    render() {
        const nameValidationState = () => {
            if (!this.state.validateName) {
                return null;
            }
            
            return this.nameIsValid() ? 'success' : 'error';
        }

        return (
            <Modal show={this.props.isVisible} onHide={() => this.props.hide()}>
                <Modal.Header closeButton>
                    <Modal.Title>
                        New Calendar
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
                        <FormGroup validationState={ nameValidationState() }>
                            <ControlLabel>Name:</ControlLabel>
                            <small className='pull-right'>required</small>
                            <FormControl
                                type="text"
                                value={this.state.name}
                                placeholder="Name"
                                onBlur={ () => { this.setState({ validateName: true }); } }
                                onChange={this.nameChanged.bind(this)} />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup validationState={ this.colourIsValid() ? 'success' : 'error' }>
                            <ControlLabel>Colour:</ControlLabel>
                            <small className='pull-right'>required</small>
                            <InputGroup>
                                <InputGroup.Addon>#</InputGroup.Addon>
                                <FormControl
                                    type="text"
                                    value={this.state.colour}
                                    placeholder="Colour"
                                    onChange={this.colourChanged.bind(this)} />
                            </InputGroup>
                            <FormControl.Feedback />
                        </FormGroup>
                        <GithubPicker
                            color={ this.state.colour }
                            onChangeComplete={ (colour) => { this.setState({ colour: colour.hex.slice(1) }); } } />
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
