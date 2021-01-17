import React from 'react'
import { connect } from 'react-redux';
import { updateCurrentDay } from '../../actions/scheduleActions';
import BeschikbaarheidDays from './BeschikbaarheidDays';

const BeschikbaarheidgWeek = ({ currentDay, schedules, date, }) => {
    return (
        <div style={{ overflowY: 'scroll' }}>
            <BeschikbaarheidDays currentDay={currentDay} date={date} schedules={schedules} />
        </div>
    )
}



const mapStateToProps = state => ({
    currentDay: state.schedule.currentDay,
    date: state.schedule.date,
    schedules: state.availability.mySchedules,
})

export default connect(mapStateToProps, { updateCurrentDay })(BeschikbaarheidgWeek)
