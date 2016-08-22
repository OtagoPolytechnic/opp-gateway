import React from 'react';
import Repo from './Repo';

export default React.createClass({

    render() {
        return (
            <div className='panel panel-default'>
                <div className='panel-heading'>{this.props.repos.title}</div>

                <ul className='list-group'>
                    {this.props.repos.data.map((repo, key) => {
                        return <Repo title={repo.title} url={repo.url} key={key} /> 
                    })}
                </ul>
            </div>
        );
    }

});
