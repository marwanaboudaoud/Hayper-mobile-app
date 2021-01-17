import React from 'react'
import { If, Then } from "react-if";
import { connect } from 'react-redux'
import {translateKeys} from '../../utils/translateKeys';
const ResponseMessage = ({ responseMessage, errorMessage }) => {
    return (
        <>
            <If condition={responseMessage}>
                <Then>
                    <p style={{ color: 'green', fontFamily: 'Avenir', fontWeight: '500' }}>{translateKeys(responseMessage)}</p>
                </Then>
            </If>
            <If condition={errorMessage}>
                <Then>
                    <p style={{ color: 'red', fontFamily: 'Avenir', fontWeight: '500' }}>{translateKeys(errorMessage)}</p>
                </Then>
            </If>
        </>
    )
}

const mapStateToProps = state => ({
    responseMessage: state.auth.message,
    errorMessage: state.auth.error
})

export default connect(mapStateToProps, {})(ResponseMessage)
