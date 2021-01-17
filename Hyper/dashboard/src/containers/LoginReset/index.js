import React, { useState, useEffect } from 'react';
import LargeImage from '../../components/LargeImage';
import Btn from '../../components/Btn';
import { connect } from 'react-redux';
import { resetPassword, resetAuth } from '../../actions/userActions'
// import Logo from "../../components/Logo";
import LogoImage from '../../assets/img/branding/logo.svg';
import Input from "../../components/Input";
import PasswordIcon from "../../assets/img/icons/password.svg";
import ResponseMessage from '../../components/ResponseMessage';

const LoginReset = ({ resetAuth, resetPassword, error, message, match: { params: { id } }, fetching }) => {
    const [password, updatePassword] = useState('');
    const [password_confirmation, uPc] = useState('')
    const [isFirstShown, updateFirstShown] = useState(false)
    const [isSecondShown, updateSecondShown] = useState(false)
    const firstIcon = <img onClick={() => updateFirstShown(!isFirstShown)} src={PasswordIcon} alt="show/hide" />;
    const secondIcon = <img onClick={() => updateSecondShown(!isSecondShown)} src={PasswordIcon} alt="show/hide" />;

    useEffect(() => {
        resetAuth()
        return () => {
            resetAuth()
        };
    }, [])

    const handleReset = (e) => {
        e.preventDefault();
        resetPassword({ password, password_confirmation, token: id })
    };

    return (
        <div className='login-block' style={{ height: '100vh', overflow: 'hidden', display: 'flex', flexDirection: 'row' }}>
            <LargeImage />
            <div className='container'>
                <form onSubmit={e => handleReset(e)} className='inner'>
                    <h1 className='title'>Wachtwoord herstellen</h1>
                    <p className='intro'>Stel je nieuwe wachtwoord in.</p>
                    <ResponseMessage />
                    <Input required={true} type={isFirstShown ? 'text' : 'password'} label='Wachtwoord' rightIcon={firstIcon} name='password' value={password} onChange={(n, v) => updatePassword(v)} />
                    <Input required={true} type={isSecondShown ? 'text' : 'password'} label='Wachtwoord herhalen' rightIcon={secondIcon} name='password_confirmation' value={password_confirmation} onChange={(n, v) => uPc(v)} />
                    <div style={{ marginTop: '60px', width: '100%' }}>
                        <Btn loading={fetching} typeOf={'submit'} type='primary large'>Wachtwoord herstellen</Btn>
                    </div>
                </form>
                <img style={{ marginTop: "30px" }} src={LogoImage} alt="" />
            </div>
        </div>

    )
}

const mapStateToProps = state => ({
    error: state.auth.error,
    message: state.auth.message,
    fetching: state.auth.fetching,
})
export default connect(mapStateToProps, { resetPassword, resetAuth })(LoginReset)