import React from 'react'
import Layout from '../../components/Layout'
import ProjectForm from './ProjectForm'

const ProjectToevoegen = () => {
    return (
       <Layout>
           <ProjectForm update={false}/>
       </Layout>
    )
}

export default ProjectToevoegen
