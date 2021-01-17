import React from 'react'
import { fetchMySalaris } from '../../actions/salarisAction'
import { connect } from 'react-redux';
import { formatMySalariesDays } from '../../utils/Date';
import SalaryDayBody from './SalaryDayBody';


const SalarisDay = ({ date, salaries, currentDay, }) => {
    return formatMySalariesDays(date, salaries).map((salary, i) => {
        return salary.date === currentDay ? <SalaryDayBody key={i} salary={salary} />
            : ''
    })
}

const mapStateToProps = state => ({
    date: state.schedule.date,
    salaries: state.salaries.salaries,
    currentDay: state.salaries.currentDay,
    loading: state.salaries.loading

})

export default connect(mapStateToProps, { fetchMySalaris })(SalarisDay)


