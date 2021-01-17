import React, { useEffect } from 'react'
import { connect } from 'react-redux';
import { formatMySalariesDays } from '../../utils/Date';
import styles from './index.module.scss'
import { updateCurrentDay } from '../../actions/scheduleActions';

const SalarisWeek = ({ currentDay, salaries, date, updateCurrentDay }) => {
    const firstDayOfWeek = formatMySalariesDays(date, salaries);
    useEffect(() => {
        updateCurrentDay(firstDayOfWeek[0].date)
    }, [date])

    return (
        <div className={styles.week}>
            {formatMySalariesDays(date, salaries).map(salary => {
                return (
                    <div key={salary.id} onClick={() => updateCurrentDay(salary.date)}
                        className={styles.weekWrapper + (currentDay === salary.date ? ` ${styles.weekWrapperActive}` : ' ')}>
                        <span style={{ fontWeight: 'bold' }}>{salary.day}</span>
                        <span className={styles.dayLetter}>{salary.dayLetter}</span>
                    </div>
                )
            }
            )}
        </div>
    )
}

const mapStateToProps = state => ({
    currentDay: state.salaries.currentDay,
    date: state.salaries.date,
    salaries: state.salaries.salaries,
})

export default connect(mapStateToProps, { updateCurrentDay })(SalarisWeek)
