import React, { useState, useEffect } from 'react';
import LargeImage from '../../components/LargeImage';
import Btn from '../../components/Btn';
// import Logo from "../../components/Logo";
import LogoImage from '../../assets/img/branding/logo.svg';
import Input from "../../components/Input";
import { connect } from 'react-redux';
import { requestPassword, resetAuth } from '../../actions/userActions'
import ResponseMessage from '../../components/ResponseMessage';

const LoginForgot = ({ requestPassword, error, message, fetching, resetAuth }) => {
    const [email, updateEmail] = useState('')
    const handleForgotCall = (e) => {
        e.preventDefault()
        requestPassword(email);
    };

    useEffect(() => {
        resetAuth()
        return () => {
            resetAuth()
        };
    }, [])
    return (
        <div className='login-block' style={{ height: '100vh', overflow: 'hidden', display: 'flex', flexDirection: 'row' }}>
            <LargeImage />
            <div className='container'>
                <form onSubmit={e => handleForgotCall(e)} className='inner'>
                    <h1 className='title'>Wachtwoord vergeten?</h1>
                    <p className='intro'>Vul het emailadres van je account in. <br />Wij versturen je een link waarmee je je wachtwoord kan herstellen.</p>
                    <ResponseMessage />
                    <Input required={true} type='text' label='Gebruikersnaam' name='email' value={email} onChange={(name, value) => updateEmail(value)} />
                    <div style={{ marginTop: '60px', width: '100%' }}>
                        <Btn loading={fetching} typeOf={'submit'} type='primary large'>Wachtwoord herstellen</Btn>
                    </div>
                </form>
                <img style={{ marginTop: "30px" }} src={LogoImage} alt="" />
            </div>
        </div>

    )

};

const mapStateToProps = state => ({
    error: state.auth.error,
    message: state.auth.message,
    fetching: state.auth.fetching,
})

export default connect(mapStateToProps, { requestPassword, resetAuth })(LoginForgot)