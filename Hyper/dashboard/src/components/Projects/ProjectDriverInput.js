import React, { useState, useRef } from 'react'
import Car from '../../assets/img/icons/car.svg';
import Search from '../../assets/img/icons/search.svg'
import { If, Then, Else } from 'react-if';
import Spinner from '../Spinner'
import { connect } from 'react-redux';
import { getEmployees, resetEmployees, searchEmployees } from '../../actions/employeeActions';
import { employeesReducer } from '../../reducers/employeesReducer';
import ProjectList from './ProjectList';
import useOuterClickNotifier from '../../utils/useOuterClickNotifier';

const ProjectDriverInput = ({date,submit ,filtered,driver,updateChosenDriver,searchEmployees,resetEmployees,chosenDriver,chosenEmployees,loading,getEmployees, employees,handleUpdate,placeholder,shift}) => {
        const [search, updateSearch] = useState('')
        const [focus , setFocus] = useState(false)
        const innerRef = useRef(null)
        useOuterClickNotifier(
            e => {
               if(chosenDriver){
                setFocus(false)
            }
        }, innerRef
    )
    const searchUpdate = (e) => {
        e.preventDefault()
        if (!loading) {
            updateSearch(e.target.value)
            searchEmployees(e.target.value)
        }
    };

    const handleOnFocus = () => {
        setFocus(true);
        updateChosenDriver(true)
        getEmployees(date, true, shift)
    }

    const handleOnBlur = (time) => {
        setTimeout(() => {
            setFocus(false)
            updateChosenDriver(false)
            updateSearch('')
            resetEmployees()
        }, time)
    }


    return (
        <div onClick={() => handleOnFocus()} ref={innerRef} className={'project__search-wrapper'}>
            <div className={'project__search ' + (focus ? ' project__search-active' : '')}>
                <div className={"project__group" + (submit && Object.keys(driver).length === 0 ? ' project__group-error' : '')}>
                    {
                        !chosenDriver ?
                            <>
                                <img className="project__img" src={Car} />
                                <div className="project__chosenDriver">{driver.first_name}</div>
                            </>
                            :
                            <>
                                <img className="project__img" src={Search} />
                                <input onChange={e => searchUpdate(e)} value={search} type="text" className="project__input" placeholder={placeholder} />
                            </>

                    }
                </div>
                <If condition={focus ? true : false}>
                    <ProjectList emptyError={'Helaas, geen chauffeur'} handleOnBlur={() => handleOnBlur(150)} chosenEmployees={chosenEmployees} handleUpdate={handleUpdate} />
                </If>
            </div>
        </div>
    )
}

const mapStateToProps = state => {
    return {
        employees: state.employees.employees,
        filtered: state.employees.filtered,
        loading: state.employees.loading
    }
}

export default connect(mapStateToProps, { getEmployees, resetEmployees, searchEmployees })(ProjectDriverInput);
