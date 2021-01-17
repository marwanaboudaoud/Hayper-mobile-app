import React, { useEffect } from 'react'
import {Fade} from 'react-reveal'
import {connect} from 'react-redux'
import { updateAppError, closeError } from '../../actions/appActions'
import {CSSTransition} from 'react-transition-group';

const Error = ({data:{error,show,id}}) => {
    useEffect(() => {
        setTimeout(() => {
            closeError(id)
        },3000)
    }, [])
    return (
            <div className="layout__error" onClick={() => closeError(id)}>
                <button type="button" class="layout__close" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span className={'layout__message'}>{error}</span>
            </div>
    )
}
const mapStateToProps = state => ({
    error: state.app.error
})
export default connect(mapStateToProps,{})(Error)
