import React, { Component } from "react";
import Menu from "../../components/menu/Menu";
import generalStyles from "../general.module.scss";
import SalarisBody from "../../components/salaris/SalarisBody";

class Salaris extends Component {
  state = {};
  render() {
    return (
      <div
        className="container"
        style={{
          height: "100vh",
          justifyContent: "unset",
          alignItems: "unset",
          padding: '0px'
        }}
      >

        <div className={generalStyles.header}>
          <Menu />
          <h4 className={generalStyles.headerTitle}>Salaris</h4>
        </div>

        <SalarisBody />
      </div>

    );
  }
}

export default Salaris;
