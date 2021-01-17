import React from 'react';
import {NavLink} from "react-router-dom";

function SubLink ({to, title}) {
    return (
        <NavLink to={to} className='sub-link' activeClassName="selected">
            {title}
        </NavLink>
    )
}

export default SubLink