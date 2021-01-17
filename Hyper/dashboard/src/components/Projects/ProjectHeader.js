import React from 'react'
import ProjectButton from './ProjectButton'
import {formatToDay} from '../../utils/Date';

const ProjectHeader = ({date,updateToggle}) => {
    
    return (
        <div className="project__wrapper">
            <div className="project__time">
                <span className="project__text">3</span>
                <span className="project__text">2.00</span>
            </div>
            <div className="project__day">
                {date}
            </div>
            <ProjectButton updateToggle={updateToggle}/>
        </div>
    )
}

export default ProjectHeader;
