import React, { Component } from 'react';
import { Switch, Route, Redirect, Router } from 'react-router-dom';
import history from '../../utils/history';
import Login from '../Login';
import LoginForgot from '../LoginForgot';
import LoginReset from '../LoginReset';
import Employees from '../Employees'
import Klanten from '../Klanten'
import Abonnementen from '../Abonnementen';
import Projecten from '../Projecten';
import Functies from '../Functies'
import * as routes from '../../utils/Routes';
import PrivateRoute from './PrivateRoute';
import Dashboard from '../Dashboard/Dashboard';
import RestrictedRoute from './RestrictedRoute';
import Weekplanning from '../Weekplanning';
import Orders from '../Orders';
import AbonnementenAdd from '../Abonnementen/AbonnementenAdd';
import AbonnementenEdit from '../Abonnementen/AbonnementenEdit';
import KlantToevoegen from '../Klanten/KlantToevoegen';
import ProjectToevoegen from '../Projecten/ProjectToevoegen';
import FunctiesAdd from '../Functies/FunctiesAdd';
import FunctiesEdit from '../Functies/FunctiesEdit';
import KlantEdit from '../Klanten/KlantEdit';
import Salaries from '../Salaries'
import SalaryDetail from '../SalaryDetails/SalaryDetail'
import ProjectEdit from '../Projecten/ProjectEdit';
import EmployeeCreate from '../Employees/EmployeeCreate';
import EmployeeEdit from '../Employees/EmployeeEdit';
import EmployeeContracts from '../Employees/EmployeeContracts'
import SalaryExpandDetails from '../../components/SalaryExpandDetails/SalaryExpandDetails';
import Salary from '../../components/Salary/Salary';

const Routes = () => {
    return (
        <Router history={history}>
            <Switch>
                {/* Accessible if not logged in */}
                <RestrictedRoute path={routes.LOGIN} exact component={Login} />
                <RestrictedRoute path={routes.LOGIN_FORGOT} exact component={LoginForgot} />
                <RestrictedRoute path={routes.LOGIN_RESET} component={LoginReset} />
                {/* PrivateRoute only when logged in */}
                <PrivateRoute path={routes.DASHBOARD} component={Dashboard} />
                <PrivateRoute path={routes.WEEKPLANNING} component={Weekplanning} />

                <PrivateRoute exact path={routes.EMPLOYEE_OVERVIEW} component={Employees} />
                <PrivateRoute exact path={routes.EMPLOYEE_ADD} component={EmployeeCreate} />
                <PrivateRoute exact path={routes.EMPLOYEE_EDIT} component={EmployeeEdit} />
                <PrivateRoute exact path={'/test'} component={SalaryDetail} />

                <PrivateRoute exact path={routes.EMPLOYEE_CONTRACTS} component={EmployeeContracts} />
                <PrivateRoute exact path={routes.EMPLOYEE_AVERAGES} component={Weekplanning} />

                <PrivateRoute exact path={routes.ORDERS_OVERVIEW} component={Orders} />
                <PrivateRoute exact path={routes.ORDERS_DENIED} component={Weekplanning} />

                <PrivateRoute exact path={routes.MANAGE_CUSTOMERS} component={Klanten} />
                <PrivateRoute exact path={routes.MANAGE_CUSTOMERS_ADD} component={KlantToevoegen} />
                <PrivateRoute exact path={routes.MANAGE_CUSTOMERS_EDIT} component={KlantEdit} />

                <PrivateRoute exact path={routes.MANAGE_SUBSCRIPTIONS_EDIT} component={AbonnementenEdit} />
                <PrivateRoute exact path={routes.MANAGE_SUBSCRIPTIONS_ADD} component={AbonnementenAdd} />
                <PrivateRoute exact path={routes.MANAGE_SUBSCRIPTIONS} component={Abonnementen} />

                {/* <PrivateRoute path={MANAGE_PROJECTS} component={ProjectToevoegen} /> */}
                <PrivateRoute exact path={routes.MANAGE_PROJECTS} component={Projecten} />
                <PrivateRoute exact path={routes.MANAGE_PROJECTS_ADD} component={ProjectToevoegen} />
                <PrivateRoute exact path={routes.MANAGE_PROJECTS_EDIT} component={ProjectEdit} />

                <PrivateRoute exact path={routes.MANAGE_ROLES} component={Functies} />
                <PrivateRoute exact path={routes.MANAGE_ROLES_ADD} component={FunctiesAdd} />
                <PrivateRoute exact path={routes.MANAGE_ROLES_EDIT} component={FunctiesEdit} />


                <PrivateRoute exact path={routes.SALARY_OVERVIEW} component={Salaries} />
                <PrivateRoute exact path={routes.SALARY_DETAIL} component={SalaryDetail} />

                {/* Redirect 404 to /login*/}
                <Route render={() => <Redirect to={routes.LOGIN} />} />
            </Switch>
        </Router>
    );
};

export default Routes;
