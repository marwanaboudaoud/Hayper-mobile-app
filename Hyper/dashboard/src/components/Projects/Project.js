import React from 'react'
import './project.scss';
import ProjectTitle from './ProjectTitle';
import ProjectDays from './ProjectDays';

const Project = ({project:{name,id,schedules}}) => {
    return (
        <div className="project">
            <ProjectTitle>{name}</ProjectTitle>
            <ProjectDays projectId={id} projectName={name} schedules={schedules}/>
        </div>
    )
}

export default Project
