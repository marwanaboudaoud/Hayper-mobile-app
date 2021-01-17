import React, { useEffect } from "react";
import { connect } from "react-redux";
import WeekplanningDays from "./WeekplanningDays";
import { fetchMySchedules } from "../../actions/scheduleActions";

const Index = ({ date, fetchMySchedules }) => {
  useEffect(() => {
    fetchMySchedules({
      "start_date": date.startOfWeek,
      "end_date": date.endOfWeek
    })
  }, [date])
  return <WeekplanningDays />
}

const mapStateToProps = state => ({
  date: state.schedule.date,
})

export default connect(mapStateToProps, { fetchMySchedules })(Index);