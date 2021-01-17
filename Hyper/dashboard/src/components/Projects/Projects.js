import React,{useState} from 'react'
import Project from './Project'

const Projects = ({projects}) => projects.map(project => <Project key={project.id} project={project}/>)
export default (Projects)
