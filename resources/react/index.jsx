// Imports
import React from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, browserHistory, IndexRoute } from 'react-router';
import 'whatwg-fetch';

// App component (has the navbar and menu, etc.)
import App from './App';

// Pages
import HomePage from './Pages/HomePage';
import MyPapersPage from './Pages/MyPapersPage';

ReactDOM.render(
    <Router history={browserHistory}>
        <Route path="/" component={App}>
            <IndexRoute component={HomePage} />

            <Route path="/my-papers" component={MyPapersPage} />
        </Route>
    </Router>,
    document.getElementById('app')
);
