import React, { Component } from "react";
import WeekPlanning from "../../pages/Weekplanning/Weekplanning";
import Beschikbaarheid from "../../pages/Beschikbaarheid/Beschikbaarheid";
import Score from "../../pages/Score/Score";
import Afvallers from "../../pages/Afvallers/Afvallers";
import Salaris from "../../pages/Salaris/Salaris";
import Declaraties from "../../pages/Declaraties/Declaraties";
import VriendAanmelden from "../../pages/VriendAanmelden/VriendAanmelden";
import Instellingen from "../../pages/Instellingen/Instellingen";
import {
  Switch,
  Route,
  Redirect,
  Router
} from "react-router-dom";
import Login from "../Login";
import LoginForgot from "../LoginForgot";
import LoginReset from "../LoginReset";
import { LOGIN, LOGIN_FORGOT, LOGIN_RESET } from "../../utils/Routes";
import PrivateRoute from "./PrivateRoute";
import RestrictedRoute from "./RestrictedRoute";
import history from '../../utils/history'

class Routes extends Component {
  render() {
    return (
      <Router history={history}>
        <Switch>
          {/* Accessible if not logged in */}
          <RestrictedRoute path={LOGIN} exact component={Login} />
          <RestrictedRoute path={LOGIN_FORGOT} exact component={LoginForgot} />
          <RestrictedRoute path={LOGIN_RESET} component={LoginReset} />
          {/* PrivateRoute only when logged in */}
          <PrivateRoute path="/WeekPlanning" exact component={WeekPlanning} />
          <PrivateRoute
            path="/Beschikbaarheid"
            exact
            component={Beschikbaarheid}
          />
          <PrivateRoute path="/Score" exact component={Score} />
          <PrivateRoute path="/Afvallers" exact component={Afvallers} />
          <PrivateRoute path="/Salaris" exact component={Salaris} />
          <PrivateRoute path="/Declaraties" exact component={Declaraties} />
          <PrivateRoute
            path="/VriendAanmelden"
            exact
            component={VriendAanmelden}
          />
          <PrivateRoute path="/Instellingen" exact component={Instellingen} />
          {/* Redirect 404 to /login*/}
          <Route render={() => <Redirect to={LOGIN} />} />
        </Switch>
      </Router>
    );
  }
}

export default Routes;
