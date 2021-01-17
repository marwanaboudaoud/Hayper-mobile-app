import { combineReducers } from 'redux'
import { connectRouter } from 'connected-react-router'
import { authReducer } from './authReducer'
import { projectsReducer } from './projectsReducer';
import { employeesReducer } from './employeesReducer';
import { tableReducer } from './tableReducer';
import { partnersReducer } from './partnersReducer';
import { subscriptionReducer } from './subscriptionReducer';
import { salaryReducer } from './salaryReducer';
import { rolesReducer } from './rolesReducer';
import { roleReducer } from './roleReducer';
import { genderReducer } from './genderReducer';
import { nationalityReducer } from './nationalityReducer';
import { countriesReducer } from './countriesReducer';
import { maritalReducer } from './maritalReducer';
import { appReducer } from './appReducer';

const createRootReducer = (history) => combineReducers({
    router: connectRouter(history),
    auth: authReducer,
    projects: projectsReducer,
    employees: employeesReducer,
    table: tableReducer,
    partners: partnersReducer,
    subscriptions: subscriptionReducer,
    salary: salaryReducer,
    roles:rolesReducer,
    role:roleReducer,
    genders:genderReducer,
    nationalities: nationalityReducer,
    countries: countriesReducer,
    maritals:maritalReducer,
    app:appReducer,
});

export default createRootReducer;