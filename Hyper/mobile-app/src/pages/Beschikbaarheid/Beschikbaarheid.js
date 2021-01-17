import React, { Component } from "react";
import Menu from "../../components/menu/Menu";
import generalStyles from "../general.module.scss";
import Calendar from "../../components/calendar/Calendar";
import BeschikbaarhiedBody from '../../components/Beschikbaarheid/BeschikbaarheidBody'

class Beschikbaarheid extends Component {
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
          <h4 className={generalStyles.headerTitle}>Beschikbaarheid</h4>
        </div>
        <div style={{ marginBottom: '25px' }}>
          <Calendar />
        </div>
        <BeschikbaarhiedBody />
      </div>
    );
  }
}

export default Beschikbaarheid;
