import React from 'react'

const ProjectApply = ({text, icon}) => 
<button className="project__bewerken"><div className='project__greencircle'><img className="project__pencil" src={icon}/></div><span>{text}</span></button>


export default ProjectApply
