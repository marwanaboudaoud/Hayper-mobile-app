import React from 'react'
import { connect } from 'react-redux'

const ProjectSelect = ({shift, changeShift}) => {
    return (
        <div className="project__group ">
            <span className="project__span"> </span>
            <select defaultValue={shift} className="project__select" onChange={e => changeShift(e.target.value)}>
                <option value={1}>Volledige dag</option>
                <option value={2}>Halve dag</option>
            </select>
        </div>
    )
}



export default connect()(ProjectSelect)
