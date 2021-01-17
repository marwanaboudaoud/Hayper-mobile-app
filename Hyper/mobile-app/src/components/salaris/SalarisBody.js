import React, { useState, useEffect } from 'react'
import { Navbar, Nav } from 'react-bootstrap'
import Calander from "../../components/calendar/Calendar";
import SalarisWeek from './SalarisWeek';
import styles from './index.module.scss'
import { If, Then } from 'react-if';
import SalarisDay from './SalarisDay';
import SalarisMonth from './SalarisMonth';
import SalarisMonthCalender from '../calendar/SalarisMonthCalender';
import SalarisWeekCalender from './SalarisWeekCalender';
import { connect } from "react-redux";
import { fetchMySalaris } from '../../actions/salarisAction';
import { calculateTotalDays } from '../../utils/calculate';
import Spinner from '../Spinner';


const SalarisBody = ({ date, fetchMySalaris, salaries, loading }) => {
    const [filterDate, updatFilterDate] = useState('day');
    useEffect(() => {
        fetchMySalaris({
            "start_date": date.startOfWeek,
            "end_date": date.endOfWeek
        })
    }, [loading])
    return (
        <>
            <Navbar className={styles.navbar}>
                <Nav.Link className={styles.navItems + (filterDate === 'day' ? ` ${styles.navItemsActive}` : ' ')} onClick={() => updatFilterDate('day')} href="#">Dag</Nav.Link>
                <Nav.Link className={styles.navItems + (filterDate === 'week' ? ` ${styles.navItemsActive}` : ' ')} onClick={() => updatFilterDate('week')} href="#">Week</Nav.Link>
                <Nav.Link className={styles.navItems + (filterDate === 'month' ? ` ${styles.navItemsActive}` : ' ')} onClick={() => updatFilterDate('month')} href="#">Maand</Nav.Link>
            </Navbar>
            <If condition={filterDate === 'day'}>
                <Then>
                    <Calander />
                    <SalarisWeekCalender />
                    <SalarisDay />
                </Then>
            </If>
            <If condition={filterDate === 'week'}>
                <Then>
                    <div style={{ marginBottom: '20px' }}>
                        <Calander />
                    </div>
                    <div style={{ marginBottom: '50px', overflowY: 'scroll' }}>
                        <SalarisWeek />
                        <div className={styles.amount} >
                            <span className={styles.amountText}>  Weektotaal</span>
                            <span className={styles.amountNo}>{loading ? <Spinner width={24} color={'white'} type={'ThreeDots'} /> : `€ ${calculateTotalDays(salaries)}`}</span>
                        </div>
                    </div>
                </Then>
            </If>
            <If condition={filterDate === 'month'}>
                <Then>
                    <div style={{ marginBottom: '20px' }}>
                        <SalarisMonthCalender />
                    </div>
                    <SalarisMonth />
                </Then>
            </If>
        </>
    )
}

const mapStateToProps = state => ({
    date: state.schedule.date,
    salaries: state.salaries.salaries,
    currentDay: state.salaries.currentDay,
    loading: state.salaries.loading,
})


export default connect(mapStateToProps, { fetchMySalaris })(SalarisBody)








