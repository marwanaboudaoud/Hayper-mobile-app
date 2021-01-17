import React from 'react'
import LocationSVG from '../../assets/img/icons/location.svg'
import Alarm from '../../assets/img/icons/alarm.svg'
const ProjectPlace = ({name,city,postcode,address,availability_shift_id}) => {
    return (
        <div className="project__shift">
            <h4 className="project__place">{name}</h4>
            <div className="project__locations">
                <img src={LocationSVG} className='project__icon' alt="Shift location"/>
                <p className="project__location">{`${address}, ${postcode} ${city}`}</p>
            </div>
            <div className="project__locations">
            <img src={Alarm} className='project__icon' alt="Alarm icon"/>
            <p className="project__location">{availability_shift_id === 1 ? 'Halve dag' : 'Volledige dag'}</p>
            </div>
        </div>
    )
}

export default ProjectPlace
