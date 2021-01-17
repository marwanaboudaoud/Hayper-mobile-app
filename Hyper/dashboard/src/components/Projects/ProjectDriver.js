import React from 'react'
import Car from '../../assets/img/icons/car.svg'
const ProjectDriver = ({driver}) => {
    const driverName = () => {
        const lastName = driver.last_name.slice(0,1);
        return `${driver.first_name} ${lastName}.`
    }
    return (
        <div className="project__wrap">
           <img className="project__car" src={Car}/> 
           <p className="project__driver">{driverName()}</p>
        </div>
    )
}

export default ProjectDriver
