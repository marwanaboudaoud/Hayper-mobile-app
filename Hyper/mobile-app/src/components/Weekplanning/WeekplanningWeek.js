import React from 'react'
import { connect } from 'react-redux';
import { formatToDay } from '../../utils/Date';
import styles from './index.module.scss'
import { updateCurrentDay } from '../../actions/scheduleActions';

const WeekplanningWeek = ({ currentDay, schedules, date, updateCurrentDay }) => {
    return (
        <div className={styles.week}>
            {formatToDay(date, schedules).map(schedule => (
                <div key={schedule.id} onClick={() => updateCurrentDay(schedule.date)}
                    className={styles.weekWrapper + (currentDay === schedule.date ? ` ${styles.weekWrapperActive}` : ' ')}>
                    <span style={{ fontWeight: 'bold' }}>{schedule.day}</span>
                    <span className={styles.dayLetter}>{schedule.dayLetter}</span>
                </div>
            )
            )}
        </div>
    )
}

const mapStateToProps = state => ({
    currentDay: state.schedule.currentDay,
    date: state.schedule.date,
    schedules: state.schedule.schedules,
})

export default connect(mapStateToProps, { updateCurrentDay })(WeekplanningWeek)
