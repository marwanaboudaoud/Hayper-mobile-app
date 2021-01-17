import React from 'react'
import ProjectItem from './ProjectItem'

const ProjectItems = ({schedules,projectName,projectId}) => 
schedules.map(schedule => <ProjectItem  projectId={projectId} projectName={projectName} key={schedule.id} schedule={schedule}/>)
export default ProjectItems
