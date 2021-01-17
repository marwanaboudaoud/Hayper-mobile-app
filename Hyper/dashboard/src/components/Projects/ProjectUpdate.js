import React from 'react'
import Pencil from '../../assets/img/icons/pen.svg'
import ProjectDelete from './ProjectDelete'
import ProjectBottom from './ProjectBottom'
import {connect} from 'react-redux'
import {removeScheduleFromProject} from '../../actions/projectAction';
const ProjectUpdate = ({toggleShow,id,removeScheduleFromProject}) => {
    return (
        <ProjectBottom>
            <button className="project__bewerken" onClick={() => toggleShow()}><div className='project__greencircle'><img className="project__pencil" alt="pencil" src={Pencil}/></div><span>Bewerken</span></button>
            <ProjectDelete click={() => removeScheduleFromProject(id)}  text="verwijderen"/>
        </ProjectBottom>
    )
}

export default connect(null,{removeScheduleFromProject})(ProjectUpdate)
