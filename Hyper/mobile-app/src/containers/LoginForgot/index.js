import React, { useState, useEffect } from "react";
import Input from "../../components/Input";
import { connect } from "react-redux";
import { requestPassword, resetAuth } from "../../actions/userActions";
import "../Login/index.css";
import LogoImage from "../../assets/img/branding/logo.svg";
import ResponseMessage from "../../components/Response/ResponseMessage";
import Spinner from "../../components/Spinner";
import { Link } from "react-router-dom";

const LoginForgot = ({ requestPassword, loading, resetAuth }) => {
  const [email, updateEmail] = useState("");

  const handleSubmit = e => {
    e.preventDefault();
    requestPassword(email);
  };

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
          <h1 className="title">Wachtwoord vergeten?</h1>
          <p className="intro">
            Vul het emaildres van je account in. Wij versturen je een link
            waarmee je je wachtwoord kan herstellen.
          </p>
          <form style={{ width: "100%" }} onSubmit={e => handleSubmit(e)}>
            <ResponseMessage />
            <Input
              type=""
              label="Emailadres"
              name="email"
              value={email}
              onChange={e => updateEmail(e.target.value)}
            />
            <button type="submit" className="loginBtn">
              <span className="loginSpan">{loading ? <Spinner width={35} color={'white'} /> : 'Wachtwoord herstellen'} </span>
            </button>
          </form>
        </div>
        <Link to="/login">
          <img alt="" className="hyper-logo" src={LogoImage} />
        </Link>
      </div>
    </div>
  );
};

const mapStateToProps = state => {
  return {
    loading: state.auth.loading
  };
};


export default connect(mapStateToProps, { requestPassword, resetAuth })(LoginForgot);
