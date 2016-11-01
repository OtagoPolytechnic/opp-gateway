import React from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, browserHistory, IndexRoute } from 'react-router';
import App from './App';

// Pages
import HomePage from './Pages/HomePage';
import CalendarPage from './Pages/CalendarPage';
import MyPapersPage from './Pages/MyPapersPage';

ReactDOM.render(
    <Router history={browserHistory}>
        <Route path="/" component={App}>
            <IndexRoute component={HomePage} />

            <Route path="/calendar" component={CalendarPage} />
            <Route path="/my-papers" component={MyPapersPage} />
        </Route>
    </Router>,
    document.getElementById('app')
);
