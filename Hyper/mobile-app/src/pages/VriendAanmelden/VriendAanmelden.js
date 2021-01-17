import React, { useState } from "react";
import { connect } from "react-redux";
import Menu from "../../components/menu/Menu";
import generalStyles from "../general.module.scss";
import styles from "./index.module.scss";
import vriendAanmelden from "../../assets/img/icons/vriendAanmelden.svg";
import { uploadVriendAanmelden } from "../../actions/VriendAanmeldenAction";
import { If, Then, Else } from "react-if";
import RedX from "../../assets/img/icons/red-x.svg";
import GreenRight from '../../assets/img/icons/green-right.svg'
import Spinner from '../../components/Spinner/index';

const VriendAanmelden = ({ uploadVriendAanmelden, loading, finished }) => {
  const [name, updateName] = useState("");
  const [phone, updatePhone] = useState("");
  const [age, updateAge] = useState("");
  const [location, updateLocation] = useState("");
  const [error, updatError] = useState(false);
  const handleSubmit = e => {
    e.preventDefault();
    if (
      name === "" ||
      phone === "" ||
      age === "" ||
      location === ""
    ) {
      updatError(true);
      return null;
    }

    const formData = new FormData();
    formData.append("name", name);
    formData.append("age", age);
    formData.append("phone", phone);
    formData.append("location", location);
    updatError(false);
    return uploadVriendAanmelden(formData);
  };


  return (
    <div
      className="container"
      style={{
        padding: '0px',
        height: "100vh",
        justifyContent: "unset",
        alignItems: "unset"
      }}
    >
      <div className={generalStyles.header}>
        <Menu />
        <h4 className={styles.headerTitle}>Vriend aanmelden</h4>
      </div>
      <div className={styles.form}>
        <div className={styles.formHeader}>
          <img
            className={styles.headerImg}
            src={vriendAanmelden}
            alt=""
          ></img>
          <p className={styles.headerP}>
            Meld een vriend aan en ontvang € 50,- *
            </p>
        </div>
        <If condition={error}>
          <Then>
            <div className={styles.errorMessageContainer}>
              <img style={{ width: "7%" }} src={RedX} alt="" />
              <span className={styles.errorMessage}>Vul alle velden in.</span>
            </div>
          </Then>
        </If>
        <form onSubmit={e => handleSubmit(e)}>
          <lable className={styles.formLable}>Volledige naam *</lable>
          <input className={styles.inputs} type="" onChange={e => updateName(e.target.value)} />
          <label className={styles.formLable}>Telefoonnummer *</label>
          <input className={styles.inputs} type="" onChange={e => updatePhone(e.target.value)} />
          <label className={styles.formLable}>Leeftijd *</label>
          <input className={styles.inputs} type="" onChange={e => updateAge(e.target.value)} />
          <label className={styles.formLable}>Vestiging *</label>
          <input className={styles.inputs} type="" onChange={e => updateLocation(e.target.value)} />
          <If condition={loading}>
            <Then>
              <div style={{ display: 'flex', justifyContent: 'center' }}>
                <Spinner color={'white'} width={40} />
              </div>
            </Then>
          </If>
          <If condition={finished}>
            <Then>
              <div className={styles.successMessageContainer}>
                <img style={{ width: "7%" }} src={GreenRight} alt="" />
                <span className={styles.successMessage}>Je aanmelding is verstuurd!</span>
              </div>
            </Then>
            <Else>
              <button className={styles.formBtn} type="submit">
                <span className={styles.formBtnText}> Aanmelden </span>
              </button>
            </Else>
          </If>
        </form>
        <p style={{ fontSize: "13px" }}>
          * De beloning wordt uitbetaald wanneer zijn/haar proefperiode goed
          is voltooid.
          </p>
      </div>
    </div>
  );
}

const mapStateToProps = state => ({
  loading: state.signingupmyfriend.loading,
  finished: state.signingupmyfriend.finished
});

export default connect(mapStateToProps, { uploadVriendAanmelden })(VriendAanmelden);
