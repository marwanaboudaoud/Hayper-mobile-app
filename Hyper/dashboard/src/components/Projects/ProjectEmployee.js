import React from 'react'

const ProjectEmployee = ({employee:{first_name, last_name,role},employee}) => {
    return (
        <div className="project__employee">
            <div className="project__employee-wrapper">
                <p className="project__name">{`${first_name} ${last_name}`}</p>
                <p className="project__role">{role.title}</p>
            </div>
            <div className="project__hours">2</div>
        </div>
    )
}

export default ProjectEmployee
