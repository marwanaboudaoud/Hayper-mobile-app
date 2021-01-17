import React, { useEffect } from 'react'
import { If, Then, Else } from 'react-if'
import { connect } from 'react-redux'
import Spinner from '../../components/Spinner'
import { formatToDay } from '../../utils/Date';
import WeekplanningDay from './WeekplanningDay';
import WeekplanningWeek from "./WeekplanningWeek";
import { updateCurrentDay } from '../../actions/scheduleActions';
import WeekplanningEmpty from './WeekplanningEmpty';

const WeekplanningDays = ({ loading, schedules, date, currentDay, updateCurrentDay }) => {
    const schedulesToWeekMap = formatToDay(date, schedules)
    useEffect(() => {
        updateCurrentDay(schedulesToWeekMap[0].date)
    }, [date])


    return (
        <If condition={loading}>
            <Then>
                <div style={{ display: 'flex', justifyContent: 'center', marginTop: '40px' }}>
                    <Spinner />
                </div>
            </Then>
            <Else>
                <WeekplanningWeek />
                {schedulesToWeekMap.map((day, i) => <div style={{ overflowY: 'scroll' }}> <WeekplanningDay key={i} day={day} /> </div>)}
                <WeekplanningEmpty currentDay={currentDay} schedules={schedulesToWeekMap} />
            </Else>
        </If>
    )
}
const mapStateToProps = state => ({
    loading: state.schedule.loading,
    date: state.schedule.date,
    schedules: state.schedule.schedules,
    currentDay: state.schedule.currentDay
})
export default connect(mapStateToProps, { updateCurrentDay })(WeekplanningDays)
