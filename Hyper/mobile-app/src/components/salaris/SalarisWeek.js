import React from 'react';
import { formatMySalariesDays } from '../../utils/Date';
import { connect } from 'react-redux';
import { fetchMyAvailability } from "../../actions/availabilityAction";
import SalarisWeekDay from './SalarisWeekDay';
import Spinner from '../Spinner'
import { If, Then, Else } from 'react-if';
import styles from './index.module.scss'


const SalarisWeek = ({ date, salaries, loading }) => {
    return (
        <If condition={loading}>
            <Then>
                <div className={styles.spinnerContainer}>
                    <Spinner />
                </div>
            </Then>
            <Else>
                {formatMySalariesDays(date, salaries).map((salary, i) => <SalarisWeekDay salary={salary} />)}
            </Else>
        </If>
    )
}

const mapStateToProps = state => ({
    date: state.availability.date,
    salaries: state.salaries.salaries,
    loading: state.salaries.loading

});

export default connect(mapStateToProps, { fetchMyAvailability })(SalarisWeek)
