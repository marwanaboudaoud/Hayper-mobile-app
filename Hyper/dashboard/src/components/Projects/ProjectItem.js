import React, { useState } from 'react'
import ProjectPlace from './ProjectPlace';
import ProjectEmployees from './ProjectEmployees';
import ProjectDriver from './ProjectDriver';
import ProjectUpdate from './ProjectUpdate';
import ProjectEdit from './ProjectEdit';
import ProjectBody from './ProjectBody';
import {If, Then} from 'react-if';

const ProjectItem = ({projectId,projectName,schedule,schedule:{availability_shift_id,id,date,name,address,postcode,city,driver,employees}}) => {
    const [show,toggleShow] = useState(false)
    return (
        <>
            <ProjectBody>
                <ProjectPlace availability_shift_id={availability_shift_id} name={name} address={address} postcode={postcode} city={city}/>
                <ProjectEmployees employees={employees}/>
                <ProjectDriver driver={driver}/>
                <ProjectUpdate id={id} toggleShow={() => toggleShow(!show)}/>
            </ProjectBody>
            <If condition={show}>
                <Then>
                    <ProjectEdit schedule={schedule} update={true} date={date} projectId={projectId} name={projectName} toggleShow={() => toggleShow(!show)}/>
                </Then>
            </If>
        </>
    )
}

export default ProjectItem
