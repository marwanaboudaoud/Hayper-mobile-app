import React from 'react'
import { If, Then, Else } from 'react-if';
import FullShift from '../../assets/img/icons/full-shift.svg';
import HalfShift from '../../assets/img/icons/half-shift.svg';
import NoShift from '../../assets/img/icons/no-shift.svg';
import styles from './index.module.scss';
import { Zoom } from 'react-reveal';
import { connect } from 'react-redux';
import Spinner from '../Spinner';

const BeschikbaarheidIcon = ({ schedule, loading }) => {
    return (
        <If condition={loading} height={'auto'}>
            <Then>
                <Spinner width={22} />
            </Then>
            <Else>
                <If condition={typeof (schedule.availability_shift_id) === 'undefined' || schedule.present === false || schedule.is_present === false}>
                    <Then>
                        <Zoom>
                            <img className={styles.dayIcon} src={NoShift} alt="" />
                        </Zoom>
                    </Then>
                    <Else>
                        <If condition={schedule.availability_shift_id === 1}>
                            <Then>
                                <Zoom>
                                    <img className={styles.dayIcon} src={FullShift} alt="" />
                                </Zoom>
                            </Then>
                            <Else>
                                <Zoom>
                                    <img className={styles.dayIcon} src={HalfShift} alt="" />
                                </Zoom>
                            </Else>
                        </If>
                    </Else>
                </If>
            </Else>
        </If>
    )
}
const mapStateToProps = state => ({
    loading: state.availability.fetchLoading
})
export default connect(mapStateToProps, {})(BeschikbaarheidIcon)
