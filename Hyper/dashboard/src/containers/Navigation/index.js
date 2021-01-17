import React, { useState, useEffect } from 'react'
import { connect } from 'react-redux';
import { signOut } from '../../actions/userActions'
import Icon from "../../components/Icon";
import logoutIcon from "../../assets/img/icons/logout.svg";
import administrationIcon from "../../assets/img/icons/administration.svg";
import dashboardIcon from "../../assets/img/icons/dashboard.svg";
import employeesIcon from "../../assets/img/icons/employees.svg";
import ordersIcon from "../../assets/img/icons/orders.svg";
import planningIcon from "../../assets/img/icons/planning.svg";
import salaryIcon from "../../assets/img/icons/salary.svg";
import NavigationLink from "../../components/NavigationLink";
import * as routes from '../../utils/Routes';
import SubLink from "../../components/SubLink";
import { withRouter } from "react-router";
import { compose } from "redux";

const Navigation = (props) => {
    const pathname = props.location.pathname.split('/')[1];

    return (
        <div className='nav-block'>
            <div className="logo-white"></div>

            <div className='navigation'>
                <NavigationLink to={routes.DASHBOARD} icon={dashboardIcon} title={'Dashboard'} />
                <NavigationLink to={routes.WEEKPLANNING} icon={planningIcon} title={'Weekplanning'} />
                {/*<NavigationLink to={routes.ORDERS_OVERVIEW} icon={ordersIcon} title={'Orders'} />*/}
                {/*{pathname === 'orders' &&*/}
                {/*<div className='submenu'>*/}
                {/*    <SubLink to={routes.ORDERS} title={'Orders overzicht'}/>*/}
                {/*    <SubLink to={routes.ORDERS_DENIED} title={'Orders Afgewezen'}/>*/}
                {/*</div>*/}
                {/*}*/}
                <NavigationLink to={routes.EMPLOYEE_OVERVIEW} icon={employeesIcon} title={'Medewerkers'} />
                {pathname === 'medewerkers' &&
                    <div className='submenu'>
                        <SubLink to={routes.EMPLOYEE_OVERVIEW} title={'Medewerkers overzicht'} />

                        <SubLink to={routes.EMPLOYEE_CONTRACTS} title={'Contracten'} />
                        {/*<SubLink to={routes.EMPLOYEE_AVERAGES} title={'Gemiddelden'}/>*/}
                    </div>
                }
                {/*<NavigationLink to={routes.SALARY_OVERVIEW} icon={salaryIcon} title={'Salaris'} />*/}

                <NavigationLink to={routes.SALARY_OVERVIEW} icon={salaryIcon} title={'Salaris'} />
                {/* {pathname === 'salaris' &&
                    <div className='submenu'>
                        <SubLink to={routes.SALARY_OVERVIEW} icon={administrationIcon} title={'Salaris overzicht'} />

                        <SubLink to={routes.MANAGE_FUNCTIONS} icon={administrationIcon} title={'Functies'}/>
                    </div>
                } */}

                <NavigationLink to={routes.MANAGE_CUSTOMERS} icon={administrationIcon} title={'Beheer'} />
                {pathname === 'beheren' &&
                    <div className='submenu'>
                        <SubLink to={routes.MANAGE_CUSTOMERS} icon={administrationIcon} title={'Klanten'} />
                        <SubLink to={routes.MANAGE_PROJECTS} icon={administrationIcon} title={'Projecten'} />
                        <SubLink to={routes.MANAGE_SUBSCRIPTIONS} icon={administrationIcon} title={'Abonnementen'} />
                        <SubLink to={routes.MANAGE_ROLES} icon={administrationIcon} title={'Functies'} />
                        {/*<SubLink to={routes.MANAGE_FUNCTIONS} icon={administrationIcon} title={'Functies'}/>*/}
                    </div>
                }
            </div>

            <div className="logout-btn" onClick={() => props.signOut()}>
                <Icon icon={logoutIcon} /> Uitloggen
            </div>
        </div>
    )

};

function mapStateToProps(state) {
    return { authenticated: state.auth.authenticated, users: state.auth.user };
}

export default withRouter(connect(mapStateToProps, { signOut })(Navigation))