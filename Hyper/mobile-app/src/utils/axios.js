import axios from 'axios';
import { apiCall, getToken, removeToken } from './helpers';
import history from './history';
import store from './Store';
import * as types from '../actions/types';


export const getHeader = (token, moreHeaders) => ({ headers: { "api-key": token, ...moreHeaders } });
export const axiosGET = (url, token) => axios.get(apiCall(url), token);
export const axiosPOST = (url, data, token) => axios.post(apiCall(url), data, token);

axios.interceptors.response.use((res) => res, function (error) {

    if (error.response.status === 403) {
        removeToken()
            .then(() => {
                store.dispatch({ type: types.UNAUTH_USER })
                history.push('/login')
            })
    }
    return Promise.reject(error)
});