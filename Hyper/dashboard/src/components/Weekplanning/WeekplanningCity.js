import React,{useState} from 'react'

const WeekplanningCity = ({onClick,currentActive,i}) => {
    return (
        <div onClick={() => onClick()}  className={"weekplanning__city " + (currentActive == i ? " weekplanning__city-active" : '')}>
            {i}
        </div>
    )
}

export default WeekplanningCity
