import React from 'react';
import LogoImage from '../../assets/img/branding/logo.svg';
import {withRouter} from 'react-router-dom';

function Logo({history}) {
    return (
        <div onClick={() => history.push('/login')} style={{cursor:'pointer',background: `url(${LogoImage}) center no-repeat`, alignSelf: 'flex-end', width: '150px', height: '60px', backgroundSize: 'cover', position: 'absolute', bottom: '10px'}}></div>
    )
}

export default withRouter(Logo);