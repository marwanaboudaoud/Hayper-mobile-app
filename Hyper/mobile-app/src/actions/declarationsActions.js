import { SEND_DECLARATIONS, FINISH_DECLARATIONS, RESET_DECLARATIONS } from './types';
import { axiosPOST, getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';


export const uploadDeclaration = payload => dispatch => {
    getToken()
        .then(({ token }) => {
            dispatch({ type: SEND_DECLARATIONS })
            axiosPOST('declarations/upload', payload, getHeader(token, { 'content-type': 'multipart/form-data' }))
                .then(({ data }) => {
                    dispatch({ type: FINISH_DECLARATIONS, payload: true })
                })
                .catch(e => dispatch({ type: FINISH_DECLARATIONS, payload: false }))
        })
};


export const resetDeclaration = () => dispatch => {
    dispatch({ type: RESET_DECLARATIONS })
};