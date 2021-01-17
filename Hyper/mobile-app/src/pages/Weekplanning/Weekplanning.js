import React, { Component } from "react";
import Menu from "../../components/menu/Menu";
import generalStyles from "../general.module.scss";
import Calendar from "../../components/calendar/Calendar";
import WeekPlanningBody from "../../components/Weekplanning/WeekplanningBody";
import { connect } from 'react-redux'

const WeekPlanning = ({ date }) => {

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
        <h4 className={generalStyles.headerTitle}>Weekplanning</h4>
      </div>
      <Calendar />
      <WeekPlanningBody date={date} />
    </div>

  );
}


function mapStateToProps(state) {
  return {
    authenticated: state.auth.authenticated,
    user: state.auth.user,

  };
}


export default connect(mapStateToProps, {})(WeekPlanning);
