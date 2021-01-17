import React from 'react'
// import TelegraafLogo from "../../assets/img/icons/telegraaf-logo.svg";
import LocationLogo from "../../assets/img/icons/location-logo.svg";
import ClockLogo from "../../assets/img/icons/clock-logo.svg";
import CarLogo from "../../assets/img/icons/car-logo.svg";
import styles from "./index.module.scss";
import { Fade } from 'react-reveal'
import { connect } from 'react-redux';
import { If, Then } from 'react-if';

const WeekplanningDay = ({ day, currentDay }) => {

    let show = () => true;
    let filteredArray = () => day.schedules.filter(week => week.date === currentDay)
    return filteredArray().map((schedule, i) =>
        <div key={i} style={{ paddingLeft: '15px', paddingRight: '15px' }} >
            {console.log(schedule)}
            <If condition={show(schedule.date)}>
                <Then>
                    <Fade>
                        <div key={schedule.id} className={styles.row} >
                            <div className={styles.componentsHeader}>
                                {/* <img src={TelegraafLogo} alt='' /> */}
                                <p className={styles.headerP}>{schedule.name}</p>
                            </div>
                            <hr className={styles.underline} />
                            <p style={{ fontWeight: 'bold', fontFamily: 'Avenir' }}>
                                {schedule.partner.name}
                            </p>
                            <div className={styles.bodyContainers}>
                                <img src={LocationLogo} alt='' />
                                <p className={styles.bodyP}>
                                    {schedule.address},<br />
                                    {schedule.postcode}
                                </p>
                            </div>
                            <div className={styles.bodyContainers}>
                                <img src={ClockLogo} alt='' />
                                <p className={styles.bodyP}>{schedule.shift}</p>
                            </div>
                            <hr className={styles.underline} />
                            <div className={styles.bodyContainers}>
                                <img src={CarLogo} alt='' />
                                <p className={styles.bodyP}>{schedule.driver.first_name} {schedule.driver.last_name}</p>
                            </div>
                        </div>
                    </Fade>
                </Then>
            </If>
        </div>
    )
};

const mapStateToProps = state => ({
    currentDay: state.schedule.currentDay
})
export default connect(mapStateToProps, {})(WeekplanningDay)
