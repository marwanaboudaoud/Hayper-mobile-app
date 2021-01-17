import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';
import store from '../utils/Store';


export const fetchNationlities = () => dispatch => {
    getToken()
    .then(({token}) => {
        axiosGET(`nationalities`,getHeader(token))
        .then(({data:{results}}) => {
            dispatch({type:types.FETCH_NATIONLITIES,payload:results})
        })
        .catch(e =>  dispatch({type:types.FETCH_NATIONLITIES,payload:[]}))
    })

};
