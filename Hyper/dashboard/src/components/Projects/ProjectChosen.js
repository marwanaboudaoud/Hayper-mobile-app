import React from 'react'

const ProjectChosen = ({employees, onDelete}) => {
    console.log(employees)
    return (
        <ul className={'project__employeesSearch'}>
            {
                employees.map((employee,i) =>(
                    <div key={i} className="project__employeeChosen">
                        <div>
                            <p className="project__employeeSearch-name">{employee.name}{employee.first_name} {employee.last_name}</p>
                            {/*<p className="project__employeeSearch-role">{employee.role}</p>*/}
                        </div>
                        <div onClick={() => onDelete(employee.id)} className="project__delete"></div>
                    </div>  
                ))
            }    
        </ul>
    )
}

export default ProjectChosen
