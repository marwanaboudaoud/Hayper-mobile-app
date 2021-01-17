import React from 'react'
import PropTypes from 'prop-types'

const ProjectDelete = ({text, click}) => <button type="button" onClick={() => click()} className="project__verwijderen"><div className='project__redcircle'></div><span>{text}</span></button>



export default ProjectDelete
