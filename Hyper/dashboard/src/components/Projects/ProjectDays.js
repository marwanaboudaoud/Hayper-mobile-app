import React,{useState, useEffect} from 'react'
import ProjectDay from './ProjectDay';
import {formatToDay} from '../../utils/Date';
import {connect} from 'react-redux';

const ProjectDays = ({date,projectId,projectName, schedules}) => {
    const [sortedSchedules, setSchedules] = useState(formatToDay(date,schedules))
    // useEffect(() => {
    //     setSchedules(formatToDay(schedules))
    // },[schedules.length])
    
    return (
        <div className="project__days">
            {sortedSchedules.map((schedule,i) => <ProjectDay projectId={projectId}  projectName={projectName} key={i} schedule={schedule}/>)}
        </div>
    )
}

function mapStateToProps(state) {
    return {
        date: state.projects.date,
    };
}
export default connect(mapStateToProps,null)(ProjectDays)
