import React, { Component } from 'react'

import { getCurrentWeek } from '../../utils/Date'
import styles from './index.module.scss'
import ArrowLeft from '../../assets/img/icons/arrow-left.svg'
import ArrowRight from '../../assets/img/icons/arrow-right.svg'
import { updateCalendarDate } from '../../actions/scheduleActions';
import { connect } from 'react-redux';
import { updateAvailabilityDate } from '../../actions/availabilityAction'

class Calendar extends Component {
  state = {
    count: 0,
    date: getCurrentWeek(0)
  }

  componentDidMount() {
    this.props.updateCalendarDate(this.state.count)
    this.props.updateAvailabilityDate(this.state.count)
  }

  incrementWeek() {
    this.setState({ count: this.state.count + 1 }, () => {
      this.setState({ date: getCurrentWeek(this.state.count) },
        () => {
          this.props.updateCalendarDate(this.state.count)
          this.props.updateAvailabilityDate(this.state.count)
        }
      )
    })
  }

  decrementWeek() {
    this.setState({ count: this.state.count - 1 }, () => {
      this.setState({ date: getCurrentWeek(this.state.count) },
        () => {
          this.props.updateCalendarDate(this.state.count)
          this.props.updateAvailabilityDate(this.state.count)
        })
    })
  }

  render() {
    const { date } = this.state
    return (
      <div className={styles.weekContainer}>
        <div className={styles.leftArrowContainer}>
          <button
            className={styles.weekarrows}
            onClick={() => this.decrementWeek()}
          >
            <img src={ArrowLeft} alt='' />
          </button>
        </div>
        <div style={{ textAlign: 'center' }}>
          <div
            className={styles.week}

          >{`Week ${date.week}`}</div>
          <div
            className={styles.dayOfWeek}
          >{`${date.startOfWeek} - ${date.endOfWeek}`}</div>
        </div>
        <div className={styles.rightArrowContainer}>
          <button
            className={styles.weekarrows}
            onClick={() => this.incrementWeek()}
          >
            <img src={ArrowRight} alt='' />
          </button>
        </div>
      </div>
    )
  }
}

export default connect(null, { updateCalendarDate, updateAvailabilityDate })(Calendar);
