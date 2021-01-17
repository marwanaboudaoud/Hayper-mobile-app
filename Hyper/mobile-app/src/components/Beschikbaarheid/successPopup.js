import React, { Component } from "react";
import Checked from '../../assets/img/icons/checked.svg'
import styles from "./index.module.scss";

class SuccessPopup extends Component {
    state = {}
    render() {
        return (<div className={styles.successPopupContainer}>
            <img className={styles.successImg} src={Checked} alt='' />
            <p className={styles.successHeader} >Beschikbaarheid aangepast!</p>

        </div>);


    }
}

export default SuccessPopup;