import React from 'react';
import LogoImage from '../../assets/img/branding/logo.svg';

function Logo(props) {
    return (
        <div style={{background: `url(${LogoImage}) center no-repeat`, alignSelf: 'flex-end', width: '150px', height: '60px', backgroundSize: 'cover'}}></div>
    )
}


export default Logo;