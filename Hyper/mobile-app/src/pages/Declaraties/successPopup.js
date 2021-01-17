import React, { Component } from "react";
import Checked from '../../assets/img/icons/checked.svg'
import styles from "./index.module.scss";
import { connect } from 'react-redux';
import { resetDeclaration } from "../../actions/declarationsActions";

const SuccessPopup = ({ resetDeclaration, loading, finished }) => {


    return (
        <div>
            <div className={styles.successPopupContainer}>
                <img className={styles.successImg} src={Checked} alt='' />
                <p className={styles.successHeader} >Declaratie ingediend!</p>
                <p className={styles.successText}> Je hoort zo spoedig mogelijk of je declaratie wordt uitbetaald.</p>
            </div>
            <div>
                <button className={styles.confirmBtn} onClick={() => resetDeclaration()}>
                    <span className={styles.confirmBtnText}>Terug</span>
                </button>
            </div>
        </div>
    );


}


const mapStateToProps = state => ({
    loading: state.declaration.loading,
    finished: state.declaration.finished
})

export default connect(mapStateToProps, { resetDeclaration })(SuccessPopup);

