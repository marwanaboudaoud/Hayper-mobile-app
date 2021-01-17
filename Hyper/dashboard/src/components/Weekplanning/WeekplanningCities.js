import React, { useState, useEffect } from 'react'
import WeekplanningCity from './WeekplanningCity'
import {formatToDay} from '../../utils/Date';
import {connect} from 'react-redux';

const WeekplanningCities = ({cities}) => {
    const [active,setActive] = useState(0)
    const [filteredCities,setCities] = useState([])
    useEffect(() => {
    let citiesArray = []
    cities.forEach(city => city.schedules.forEach(schedule => citiesArray.push(schedule.city)))
    setCities(citiesArray.filter((el,i,self) => i === self.indexOf(el)))
    },[cities])
    return (
        <div className="weekplanning__cities">
            {filteredCities.map((i,index) => <WeekplanningCity city={i} key={index} i={i} onClick={() => setActive(i)} currentActive={active}/>)}
        </div>
    )
}

function mapStateToProps(state) {
    return {
        date: state.projects.date,
    };
}
export default connect(mapStateToProps,{})(WeekplanningCities)
