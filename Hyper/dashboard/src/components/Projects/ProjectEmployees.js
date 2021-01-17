import React from 'react'
import ProjectEmployee from './ProjectEmployee'

const ProjectEmployees = ({employees}) => {
    return (
        <div>
            {employees.map(employee => <ProjectEmployee key={employee.id} employee={employee}/>)}
        </div>
    )
}

export default ProjectEmployees
