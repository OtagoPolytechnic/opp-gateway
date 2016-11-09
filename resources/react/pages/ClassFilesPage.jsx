import React from 'react';
import RepoList from '../components/RepoList';
import 'whatwg-fetch';

export default React.createClass({

    getInitialState() {
        return {
            repos: []
        };
    },
    
    render() {
        return (
            <div className="main-content">
                <RepoList repos={this.state.repos} />
            </div>
        );
    }

});
