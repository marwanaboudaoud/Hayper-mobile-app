import React, { Component } from 'react'

import { getThisMonth } from '../../utils/Date'
import styles from './index.module.scss'
import ArrowLeft from '../../assets/img/icons/arrow-left.svg'
import ArrowRight from '../../assets/img/icons/arrow-right.svg'
import { updateCalendarDate } from '../../actions/scheduleActions';
import { connect } from 'react-redux';
import { updateSalaryDate } from '../../actions/salarisAction'

class SalarisMonthCalender extends Component {
    state = {
        count: 0,
        date: getThisMonth(0)
    }

    incrementMonth() {
        this.setState({ count: this.state.count + 1 }, () => {
            this.setState({ date: getThisMonth(this.state.count) },
                () => {
                    //   this.props.updateCalendarDate(this.state.count)
                    this.props.updateSalaryDate(this.state.count)
                }
            )
        })
    }

    decrementMonth() {
        this.setState({ count: this.state.count - 1 }, () => {
            this.setState({ date: getThisMonth(this.state.count) },
                () => {
                    // this.props.updateCalendarDate(this.state.count)
                    this.props.updateSalaryDate(this.state.count)
                })
        })
    }

    componentDidMount() {
        //this.props.updateCalendarDate(this.state.count)
        this.props.updateSalaryDate(this.state.count)
    }

    render() {
        const { date } = this.state
        return (
            <div className={styles.weekContainer}>
                <div className={styles.leftArrowContainer}>
                    <button
                        className={styles.weekarrows}
                        onClick={() => this.decrementMonth()}
                    >
                        <img src={ArrowLeft} alt='' />
                    </button>
                </div>
                <div style={{ textAlign: 'center' }}>
                    <div
                        className={styles.month}

                    >{`${date.month}`}</div>

                </div>
                <div className={styles.rightArrowContainer}>
                    <button
                        className={styles.weekarrows}
                        onClick={() => this.incrementMonth()}
                    >
                        <img src={ArrowRight} alt='' />
                    </button>
                </div>
            </div>
        )
    }
}

export default connect(null, { updateCalendarDate, updateSalaryDate })(SalarisMonthCalender);
