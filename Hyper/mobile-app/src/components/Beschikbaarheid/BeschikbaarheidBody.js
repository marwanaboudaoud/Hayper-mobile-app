import React, { useEffect } from "react";
import { connect } from "react-redux";
import { fetchMyAvailability } from "../../actions/availabilityAction";
import BeschikbaarheidgWeek from './BeschikbaarheidWeek'

const Index = ({ date, fetchMyAvailability }) => {
    useEffect(() => {
        fetchMyAvailability({
            "start_date": date.startOfWeek,
            "end_date": date.endOfWeek
        })
    }, [date.startOfWeek])
    return <BeschikbaarheidgWeek />

}

const mapStateToProps = state => ({
    date: state.availability.date,
    loading: state.availability.fetchLoading,
    mySchedules: state.availability.mySchedules
})

export default connect(mapStateToProps, { fetchMyAvailability })(Index);