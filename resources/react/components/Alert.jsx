import * as React from "react";
import { Alert } from 'react-bootstrap';

export default class CreateEventModal extends React.Component {

    render() {
        const alertType = this.props.alertType || 'info';

        // Message can either be an array or a string.
        // Let's just force it to be an array
        const messages = [].concat(this.props.message);

        return (
            <Alert bsStyle={ alertType }>
                { this.props.heading &&
                    <b>{ this.props.heading }</b>
                }
                {
                    messages.map((message, index) => {
                        return <div key={ index }>{ message }</div>
                    })
                }
            </Alert>
        );
    }

}
