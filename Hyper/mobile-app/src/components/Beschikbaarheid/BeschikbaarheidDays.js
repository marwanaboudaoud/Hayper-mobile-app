import React from 'react'
import { formatToBeschikbaarHeid, formatDayToNaL, formatDayToNaL2 } from '../../utils/Date';
import styles from './index.module.scss'
import Popup from "reactjs-popup";
import PopupForm from "./PopupForm";
import BeschikbaarheidIcon from './BeschikbaarheidIcon';
import { isObjectEmpty } from '../../utils/helpers';


const BeschikbaarheidDays = ({ currentDay, date, schedules }) => {
    return formatToBeschikbaarHeid(date, schedules).map((schedule, i) => (
        <Popup
            key={i}
            modal
            trigger={
                <div style={{ paddingLeft: '15px', paddingRight: '15px' }}>
                    <div className={styles.weekWrapper + (currentDay === schedule.date ? ` ${styles.weekWrapperActive}` : ' ')}>
                        <span>{formatDayToNaL(schedule.date)}</span>
                        <span className={styles.date}>{formatDayToNaL2(schedule.date)}</span>
                        <BeschikbaarheidIcon schedule={schedule.schedules} />
                    </div>
                </div>
            }
        >
            {close => <PopupForm schedule={schedule.schedules} update={isObjectEmpty(schedule.schedules)} close={close} currentDay={schedule.date} />}
        </Popup>
    )
    )

}

export default BeschikbaarheidDays
