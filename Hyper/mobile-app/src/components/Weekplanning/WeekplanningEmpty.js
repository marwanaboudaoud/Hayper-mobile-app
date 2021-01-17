import React from 'react'
import styles from './index.module.scss'
import { Fade } from 'react-reveal'


function WeekplanningEmpty({ schedules, currentDay }) {
    const filtered = schedules.filter(({ date }) => date === currentDay)
    if (filtered.length > 0 && filtered[0].schedules.length === 0) {
        return (
            <Fade>
                <div style={{ paddingLeft: '15px', paddingRight: '15px' }}>
                    <div className={styles.row}>
                        <p className={styles.noSchedulesText}>Er is deze dag niets ingepland.</p>
                    </div>
                </div>
            </Fade>
        )
    } return null
}

export default WeekplanningEmpty
