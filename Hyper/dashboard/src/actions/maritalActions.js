import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';
import store from '../utils/Store';


export const fetchMarital = () => dispatch => {
    getToken()
    .then(({token}) => {
        axiosGET(`maritalstatuses`,getHeader(token))
        .then(({data:{results}}) => {
            console.log(results)
            dispatch({type:types.FETCH_MARITALS,payload:results})
        })
        .catch(e =>  dispatch({type:types.FETCH_MARITALS,payload:[]}))
    })
};
