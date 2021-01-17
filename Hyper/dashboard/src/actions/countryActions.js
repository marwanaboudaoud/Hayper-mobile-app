import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';
import store from '../utils/Store';


export const fetchCountries = () => dispatch => {
    getToken()
    .then(({token}) => {
        axiosGET(`countries`,getHeader(token))
        .then(({data}) => {
            dispatch({type:types.FETCH_COUNTRIES,payload:data})
        })
        .catch(e => dispatch({type:types.FETCH_COUNTRIES,payload:[]}))
    })
};
