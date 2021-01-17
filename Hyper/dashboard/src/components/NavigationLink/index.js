import React from 'react';
import Icon from "../Icon";
import {NavLink} from "react-router-dom";

function NavigationLink ({to, icon, title}) {
    return (
        <NavLink to={to} className='link' activeClassName="selected">
            <Icon icon={icon}/> {title}
        </NavLink>
    )
}

export default NavigationLink