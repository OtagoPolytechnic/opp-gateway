import React from 'react';
import Calendar from '../components/Calendar';
import 'whatwg-fetch';

export default React.createClass({
    getInitialState() {
        return {
            'events': []
        };
    },

    componentDidMount: function() {
        // this.fetchEventsRequest = this.fetchEvents(1);
    },

    componentWillUnmount: function() {
        // this.fetchEventsRequest.abort();
    },
    
    render() {
        return (
            <div>
                <h2 className="page-title">Calendar</h2>

                <Calendar events={this.state.events} />
            </div>
        );
    }
});
