import React from 'react'
import { If, Then, Else } from 'react-if';
import Spinner from '../Spinner'
import { connect } from 'react-redux';

const ProjectList = ({ emptyError, loading, filtered, handleUpdate, chosenEmployees, handleOnBlur }) => {
    const reFilter = () => {
        const data = filtered.filter(el => {
            const exists = !chosenEmployees.find(e => {
                return e.id === el.id
            })
            return exists;
        })
        return data;
    }
    return (
        <ul className={'project__employeesSearch'}>
            <If condition={loading}>
                <Then>
                    <Spinner />
                </Then>
                <Else>
                    {reFilter().length === 0 ?
                        <li className={'project__employeeSearch'}>
                            {emptyError}
                        </li> :

                        reFilter().map(employee => (
                            <li onClick={() => {
                                handleUpdate(employee)
                                handleOnBlur()
                            }} className={'project__employeeSearch'} key={employee.id}>
                                <p className="project__employeeSearch-name">{employee.name}</p>
                                {/*<p className="project__employeeSearch-role">{employee.role}</p>*/}
                            </li>
                        ))}
                </Else>
            </If>
        </ul>
    )
}

const mapStateToProps = state => {
    return {
        employees: state.employees.employees,
        filtered: state.employees.filtered,
        loading: state.employees.loading
    }
}

export default connect(mapStateToProps, {})(ProjectList);


