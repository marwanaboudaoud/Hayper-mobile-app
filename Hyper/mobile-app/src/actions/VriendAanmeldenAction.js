import { SEND_VRIEND_AANMELDEN, FINISH_VRIEND_AANMELDEN } from './types';
import { axiosPOST, getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';


export const uploadVriendAanmelden = payload => dispatch => {
    getToken()
        .then(({ token }) => {
            dispatch({ type: SEND_VRIEND_AANMELDEN })
            axiosPOST('signing-up-my-friend', payload, getHeader(token, { 'content-type': 'multipart/form-data' }))
                .then(({ data }) => {
                    dispatch({ type: FINISH_VRIEND_AANMELDEN, payload: true })
                })
                .catch(e => dispatch({ type: FINISH_VRIEND_AANMELDEN, payload: false }))
        })
};

