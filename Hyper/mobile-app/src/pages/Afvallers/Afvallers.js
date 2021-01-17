import React, { Component } from "react";
import Menu from "../../components/menu/Menu";
import generalStyles from "../general.module.scss";
import styles from "./index.module.scss";

class Afvallers extends Component {
  state = {};
  render() {
    return (
      <div
        className="container"
        style={{
          height: "100vh",
          justifyContent: "unset",
          alignItems: "unset"
        }}
      >
        <div className={generalStyles.header}>
          <Menu />
          <h4 className={generalStyles.headerTitle}>Afvallers</h4>
        </div>
        <div style={{ marginTop: "10px" }}>
          <div className={styles.row}>
            <div className={styles.componentsHeader}>
              <p className={styles.id}>ID: 123</p>
              <p>06-08-2019</p>
            </div>
            <hr className={styles.underline} />
            <div className={styles.componentBody}>
              <p>
                Anders: Ik ben er toch niet
                <br /> geheel tevreden mee
              </p>
              <p className={styles.amount}> € -25,00</p>
            </div>
          </div>
          <div className={styles.row}>
            <div className={styles.componentsHeader}>
              <p className={styles.id}>ID: 123</p>
              <p>14-08-2019</p>
            </div>
            <hr className={styles.underline} />
            <div className={styles.componentBody}>
              <p>Reden onbekend</p>
              <p className={styles.amount}> € -25,00</p>
            </div>
          </div>
          <div className={styles.row}>
            <div className={styles.componentsHeader}>
              <p className={styles.id}>ID: 123</p>
              <p>21-08-2019</p>
            </div>
            <hr className={styles.underline} />
            <div className={styles.componentBody}>
              <p>Kom er niet aan toe</p>
              <p className={styles.amount}> € -25,00</p>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default Afvallers;
