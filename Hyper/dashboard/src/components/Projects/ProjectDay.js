import React,{useState} from 'react'
import ProjectHeader from './ProjectHeader';
import ProjectItems from './ProjectItems';
import ProjectEdit from './ProjectEdit';
import {If, Then} from 'react-if';

const ProjectDay = ({schedule,projectName,projectId}) => {
    const [toggle , updateToggle] = useState(false)
    return (
        <div className="project__item">
            <ProjectHeader updateToggle={() => updateToggle(!toggle)} date={schedule.formatedDate}/>
            <ProjectItems projectId={projectId} projectName={projectName} schedules={schedule.schedules}/>
            <If condition={toggle}>
                <Then>
                  <ProjectEdit toggleShow={() => updateToggle(!toggle)} projectId={projectId} date={schedule.date} update={false}/>
                </Then>
            </If>
        </div>
    )
}

export default ProjectDay
