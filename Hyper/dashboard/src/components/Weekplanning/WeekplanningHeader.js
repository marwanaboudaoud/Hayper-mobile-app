import React from 'react'
import './style.scss';
import WeekplanningTitle from './WeekplanningTitle';
import WeekplanningDate from './WeekplanningDate' ;

const WeekplanningHeader = () => {
    return (
        <div className="weekplanning">
            <WeekplanningTitle title={'Weekplanning'}/>
            <WeekplanningDate/>
        </div>
    )
}

export default WeekplanningHeader;
