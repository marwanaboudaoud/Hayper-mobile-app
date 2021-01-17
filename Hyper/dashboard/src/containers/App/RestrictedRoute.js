import React from 'react';
import { Route, Redirect } from 'react-router-dom';
import { connect } from 'react-redux';

const RestrictedRoute = ({authenticated,component: Component, ...rest}) => {
    return (

        // Show the component only when the user is not logged in
        // Otherwise, redirect the user to /dashboard page
        <Route {...rest} render={props => (
            authenticated ?
                <Redirect to="/dashboard" />
            : <Component {...props} />
        )} />
    );
};


function mapStateToProps(state) {
    return { authenticated: state.auth.authenticated };
}

export default connect(mapStateToProps)(RestrictedRoute);