import React, { Component } from "react";
import Failed from '../../assets/img/icons/failed.svg'
import styles from "./index.module.scss";

class FailedPopup extends Component {
    state = {}
    render() {
        return (<div className={styles.successPopupContainer}>
            <img className={styles.successImg} src={Failed} alt='' />
            <p className={styles.failedHeader} >Aanpassing geweigerd.</p>
            <p className={styles.successText}> Je kan je beschikbaarheid voor deze week na Maandag 12:00 uur niet meer aanpassen.</p>

        </div>);


    }
}

export default FailedPopup;