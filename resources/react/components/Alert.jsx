import * as React from "react";
import { Alert as BootstrapAlert } from 'react-bootstrap';

export default class Alert extends React.Component {

    render() {
        const alertType = this.props.alertType || 'info';

        // Message can either be an array or a string.
        // Let's just force it to be an array
        const messages = [].concat(this.props.message);

        return (
            <BootstrapAlert bsStyle={ alertType }>
                { this.props.heading &&
                    <b>{ this.props.heading }</b>
                }
                {
                    messages.map((message, index) => {
                        return <div key={ index }>{ message }</div>
                    })
                }
            </BootstrapAlert>
        );
    }

}
