import React from 'react'
import { Link } from 'react-router'
import NavLink from './components/NavLink'

export default React.createClass({
    getInitialState() {
        return {
            menuCollapsed: false
        }
    },

    menuButtonClicked() {
        let menuCollapsed = !this.state.menuCollapsed;
        this.setState({ menuCollapsed });
    },

    render() {
        return (
            <div className={this.state.menuCollapsed ? 'menu-draw-collpased' : ''}>
                {/* MENU DRAW */}
                <nav className="menu-draw">
                    {/* NAV BRAND/HAMBURGER BUTTON */}
                    <nav className="menu-header">
                        <i className="fa fa-bars menu-draw-toggle" onClick={this.menuButtonClicked}></i>
                        <a className="navbar-brand" href="#">OPP Gateway</a>
                    </nav>

                    {/* MENU */}
                    <div className="menu-draw-section">
                        <ul>
                            <li>
                                <NavLink to="/" onlyActiveOnIndex={true}>
                                    <i className="fa fa-home" aria-hidden="true"></i> Home
                                </NavLink>
                            </li>
                            <li>
                                <NavLink to="/calendar">
                                    <i className="fa fa-calendar" aria-hidden="true"></i> Calendar
                                </NavLink>
                            </li>
                            <li>
                                <NavLink to="/my-papers">
                                    <i className="fa fa-leanpub" aria-hidden="true"></i> My Papers
                                </NavLink>
                            </li>
                        </ul>
                    </div>

                    {/* EXTERNAL LINKS */}
                    <div className="menu-draw-section">
                        <span className="menu-section-title">Handy Links</span>
                        <ul>
                            <li>
                                <a href="http://gitlab.op-bit.nz">
                                    <i className="fa fa-code-fork" aria-hidden="true"></i> GitLab
                                </a>
                            </li>
                            <li>
                                <a href="https://mattermost.op-bit.nz/op-bit/">
                                    <i className="fa fa-comment" aria-hidden="true"></i> Mattermost
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                {/* MAIN CONTENT CONTAINER */}
                <div className="main-container">
                    {this.props.children}
                </div>
            </div>
        )
    }
})
