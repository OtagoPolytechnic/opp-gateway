import React from 'react';
import RepoListGroup from './RepoListGroup';
import Repo from './Repo';

export default React.createClass({

    render() {
        return (
            <div>
                {this.props.repos.map((repoGroup, key) => {
                    return <RepoListGroup repos={repoGroup} key={key} />;
                })}
            </div>
        );
    }

});
