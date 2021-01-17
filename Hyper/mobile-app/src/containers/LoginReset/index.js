import React, { useState, useEffect } from "react";
import Input from "../../components/Input";
import "../Login/index.css";
import { connect } from "react-redux";
import LogoImage from "../../assets/img/branding/logo.svg";
import { resetPassword, resetAuth } from "../../actions/userActions";
import PasswordIcon from "../../assets/img/icons/password.svg";
import ResponseMessage from "../../components/Response/ResponseMessage";
import Spinner from "../../components/Spinner";

const LoginReset = ({ resetPassword, match, loading, resetAuth }) => {
  const [password, updatePassword] = useState("");
  const [password_confirmation, updatePasswordC] = useState("");
  const [show, toggleShow] = useState(false);

  const handleSubmit = e => {
    e.preventDefault();
    const token = match.params.id;
    resetPassword({ password, password_confirmation, token });
  };
  const rightIcon = (
    <img onClick={() => toggleShow(!show)} src={PasswordIcon} alt="show/hide" />
  );

  useEffect(() => {
    resetAuth()
    return () => resetAuth()
  }, [])

  return (
    <div
      className="main"
      style={{
        height: "100vh"
      }}
    >
      <div className="container">
        <div className="inner">
          <h1 className="title">Wachtwoord herstellen</h1>
          <p className="intro">Stel je nieuwe wachtwoord in.</p>
          <form style={{ width: "100%" }} onSubmit={e => handleSubmit(e)}>
            <ResponseMessage />
            <Input
              type={show ? "text" : "password"}
              label="Nieuw wachtwoord "
              name="email"
              value={password}
              rightIcon={rightIcon}
              onChange={e => updatePassword(e.target.value)}
            />
            <Input
              type={show ? "text" : "password"}
              label="Wachtwoord herhalen"
              name="email"
              value={password_confirmation}
              rightIcon={rightIcon}
              onChange={e => updatePasswordC(e.target.value)}
            />
            <button type="submit" className="loginBtn">
              <span className="loginSpan"> {loading ? <Spinner width={35} color={'white'} /> : 'Wachtwoord herstellen'} </span>
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


export default connect(mapStateToProps, { resetPassword, resetAuth })(LoginReset);
