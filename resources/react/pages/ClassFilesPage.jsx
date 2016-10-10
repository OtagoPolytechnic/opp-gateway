import React from 'react';
import RepoList from '../components/RepoList';
import 'whatwg-fetch';

export default React.createClass({

    getInitialState() {
        return {
            repos: []
        };
    },

    // Fetch the class materials
    componentWillMount() {
        this.classMaterialsRequest = this.fetchClassMaterials();
    },

    // Abort the fetching of class materials to avoid a memory leak
    componentWillUnmount() {
        this.classMaterialsRequest.abort();
    },

    fetchClassMaterials() {
        fetch('http://gateway.dev/api/v1/class-material')
            .then((response) => {
                return response.json()
            }).then((json) => {
                let data = json.data.class_materials;
                
                let repos = {"title": "First Year"};
                let temp = [];

                data[1].map((task) => {
                    temp.push(
                        {
                            id: task.id,
                            name: task.name
                        }
                    );
                });

                this.setState({ repos });
            });
    },
    
    render() {
        return (
            <div>
                <h2 className="page-title">Class materials</h2>
                
                <div className="main-content">
                    <RepoList repos={this.state.repos} />
                </div>
            </div>
        );
    }

});
