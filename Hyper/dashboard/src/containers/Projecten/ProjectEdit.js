import React from 'react'
import Layout from '../../components/Layout'
import ProjectForm from './ProjectForm'

const ProjectEdit = ({match:{params:{id}}}) => {
    return (
       <Layout>
           <ProjectForm id={id} update={true}/>
       </Layout>
    )
}

export default ProjectEdit
