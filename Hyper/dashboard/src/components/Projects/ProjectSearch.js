import React,{useState} from 'react'
import Search from '../../assets/img/icons/search.svg'
import {If, Then,Else} from 'react-if';
import Spinner from '../Spinner'
import {connect} from 'react-redux';
import {getEmployees, resetEmployees,searchEmployees} from '../../actions/employeeActions';
import { employeesReducer } from '../../reducers/employeesReducer';
import ProjectList from './ProjectList';

const ProjectSearch = ({shift,date,submit,filtered,searchEmployees,resetEmployees,chosenEmployees,loading,getEmployees, employees,handleUpdate,placeholder}) => {
        const [search, updateSearch] = useState('')
        const [focus , setFocus] = useState(false)

        const searchUpdate = (e) => {
            e.preventDefault()
            if(!loading) {
                updateSearch(e.target.value)
                searchEmployees(e.target.value)
            }
        };

        const handleOnFocus = () => {
            setFocus(true);
            getEmployees(date,false,shift)
            
        }

        const handleOnBlur = (time) => {
           setTimeout(() => {
            setFocus(false)
            updateSearch('')
            resetEmployees()
           },time)
        }


    return (
        <div onFocus={() => handleOnFocus()} onBlur={() => handleOnBlur(150)} className={'project__search-wrapper'}>
            <div className={'project__search ' + (focus ? ' project__search-active' : '')}>
                <div className={"project__group" +  (submit && chosenEmployees.length === 0 ? ' project__group-error' : '')}>
                    <img className="project__img" src={Search}/>
                    <input onChange={e => searchUpdate(e)} value={search} type="text" className="project__input" placeholder={placeholder}/>
                </div>
                <If condition={focus ? true : false}>
                    <ProjectList emptyError={'Helaas, geen medewerker'} handleOnBlur={() => handleOnBlur(0)} chosenEmployees={chosenEmployees} handleUpdate={handleUpdate}/>
                </If>
            </div>
        </div>
    )
}

const mapStateToProps = state => {
    return {
        employees : state.employees.employees,
        filtered: state.employees.filtered,
        loading: state.employees.loading
    }
}

export default connect(mapStateToProps,{getEmployees,resetEmployees,searchEmployees})(ProjectSearch);
