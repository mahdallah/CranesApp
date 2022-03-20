import { Component } from "react"
import {  NavLink } from 'react-router-dom';

class NavItem extends Component {
    render() {
        return (
            <li className="nav-item">
                <NavLink
                    to={this.props.link}
                    className="nav-link"
                    activeClassName="active"
                    aria-current="page"
                >
                    {this.props.name}
                </NavLink>
            </li>
        )
    }
}
export default NavItem 