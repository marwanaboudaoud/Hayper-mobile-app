import React, { useState, useEffect } from "react";
import Input from "../../components/Input";
// import Btn from "../../components/Btn";
import { Link } from "react-router-dom";
import "./index.css";
import { connect } from "react-redux";
import LogoImage from "../../assets/img/branding/logo.svg";
import PasswordIcon from "../../assets/img/icons/password.svg";
import { login, resetAuth } from "../../actions/userActions";
import ResponseMessage from "../../components/Response/ResponseMessage";
import Spinner from "../../components/Spinner";


const Login = ({ history, login, loading, resetAuth }) => {
  const [email, updateEmail] = useState("");
  const [password, updatePassword] = useState("");
  const [show, toggleShow] = useState(false);
  const [isLogin, setLogin] = useState(false);


  const handleSubmit = e => {
    e.preventDefault();
    if (!isLogin) {
      login({ email, password });
    }
    setLogin(true);
  };

  useEffect(() => {
    resetAuth()
    return () => resetAuth()
  }, [])

  function refreshPage() {
    history.push('/forgot')
  }

  const rightIcon = (
    <img onClick={() => toggleShow(!show)} src={PasswordIcon} alt="show/hide" />
  );

  return (
    <div
      className="main"
      style={{
        height: "100vh"
      }}
    >
      <div className="container">
        <div className="inner">
          <h1 className="title">Login</h1>
          <p className="intro">Login op de werknemers app.</p>
          <form style={{ width: "100%" }} onSubmit={e => handleSubmit(e)}>
            <ResponseMessage />
            <Input
              type=""
              label="E-mail"
              name="email"
              value={email}
              onChange={e => updateEmail(e.target.value)}
            />
            <Input
              type={show ? "text" : "password"}
              label="Wachtwoord"
              name="password"
              value={password}
              rightIcon={rightIcon}
              onChange={e => updatePassword(e.target.value)}
            />
            <div style={{ display: "flex", justifyContent: "flex-end" }}>
              <Link onClick={() => refreshPage()} className="forgotten"  >
                Wachtwoord vergeten?
              </Link>
            </div>
            <button type="submit" className="loginBtn">
              <span className="loginSpan">{loading ? <Spinner width={35} color={'white'} /> : 'Inloggen'}</span>
            </button>
          </form>
        </div>

        <img alt="" className="hyper-logo" src={LogoImage} />

      </div>
    </div>
  );
};

const mapStateToProps = state => {
  return {
    loading: state.auth.loading
  };
};

export default connect(mapStateToProps, { login, resetAuth })(Login);
