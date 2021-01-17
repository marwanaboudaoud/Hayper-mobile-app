import React, { useEffect } from 'react'
import {connect} from 'react-redux'
import { updateAppError } from '../../actions/appActions'
import Error from './Error'
import {TransitionGroup,CSSTransition} from 'react-transition-group';

const Errors = ({errors}) => {

    const child = errors.map((error,i) => (
        <CSSTransition timeout={500} classNames="layout">
            <Error key={i} data={error}/>
        </CSSTransition>
    ))
    
    

    return (
        <TransitionGroup className="layout__errors">
            {child}
        </TransitionGroup>
    )
}

const mapStateToProps = state => ({
    errors: state.app.errors
})
export default connect(mapStateToProps,{})(Errors)
