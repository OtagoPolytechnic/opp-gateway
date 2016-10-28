import * as React from "react";
import { Button, Modal, ControlLabel, FormControl } from 'react-bootstrap';
import * as axios from 'axios';

export default class SignatureSelector extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            selectedCalendarId: -1
        };
    }

    save() {
        this.props.hide();
    }

    render() {
        return (
            <Modal show={this.props.isVisible} onHide={() => this.props.hide()}>
                <Modal.Header closeButton>
                    <Modal.Title>Add Event to {this.props.calendarName}</Modal.Title>
                </Modal.Header>

                <Modal.Body>
                    <form>
                        <ControlLabel>Calendar</ControlLabel>
                        <FormControl componentClass="select">
                            <option value="select">select (multiple)</option>
                            <option value="other">...</option>
                        </FormControl>
                    </form>
                </Modal.Body>

                <Modal.Footer>
                    <Button onClick={() => this.props.hide()}>Close</Button>
                    <Button bsStyle='primary' onClick={this.save.bind(this)}>Save</Button>
                </Modal.Footer>
            </Modal>
        )
    }
}
