import React, { useState, useEffect } from 'react';
import LargeImage from '../../components/LargeImage';
import Btn from '../../components/Btn';
import { connect } from 'react-redux';
import { login, resetAuth } from '../../actions/userActions'
import LogoImage from '../../assets/img/branding/logo.svg';
import Input from "../../components/Input";
import { Link } from "react-router-dom";
import PasswordIcon from "../../assets/img/icons/password.svg";
import ResponseMessage from '../../components/ResponseMessage';


const Login = ({ login, error, loading, resetAuth }) => {
    const [email, updateEmail] = useState('');
    const [isLogin, setLogin] = useState(false);
    const [password, updatePassword] = useState('')
    const [isPasswordShown, updatePasswordShown] = useState(false)
    const rightIcon = <img onClick={() => updatePasswordShown(!isPasswordShown)} src={PasswordIcon} alt="show/hide" />;



    const handleLogin = e => {
        e.preventDefault();
        if (!isLogin) {
            login({ email, password })
            .then(() => setLogin(false))
            .catch(() => setLogin(false))
        }
        setLogin(true);
    };

    useEffect(() => {
        resetAuth()
        return () => {
            resetAuth()
            setLogin(false)
        };
    }, [])

    return (
        <div className='login-block' style={{ height: '100vh', overflow: 'hidden', display: 'flex', flexDirection: 'row' }}>
            <LargeImage />
            <div className='container'>
                <form onSubmit={e => handleLogin(e)} className='inner'>
                    <h1 className='title'>Login</h1>
                    <p className='intro'>Login om het Hyper Dashboard te gebruiken.</p>
                    <ResponseMessage />
                    <Input required={true} type='text' label='Gebruikersnaam' name='email' value={email} onChange={(n, v) => updateEmail(v)} />
                    <Input required={true} type={isPasswordShown ? 'text' : 'password'} label='Wachtwoord' name='password' rightIcon={rightIcon} value={password} onChange={(n, v) => updatePassword(v)} />
                    <Link className='link' to='/forgot'>Wachtwoord vergeten?</Link>
                    <Btn loading={loading} type='primary large mt-5'>Inloggen</Btn>
                </form>
                <img style={{ marginTop: "30px" }} src={LogoImage} alt="" />
            </div>
        </div>
    )
}

const mapStateToProps = state => ({
    error: state.auth.error,
    loading: state.auth.fetching,
});

export default connect(mapStateToProps, { login, resetAuth })(Login)