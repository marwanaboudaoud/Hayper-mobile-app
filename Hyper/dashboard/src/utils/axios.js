import axios from 'axios';
import {apiCall,getToken,removeToken} from './helpers';
import history from './history';
import store from './Store';
import * as types from '../actions/types';

export const getHeader = token => ({ headers: { 'api-key': token } })
export const axiosGET = (url, token) => axios.get(apiCall(url), token)
export const axiosPOST = (url, data, token) => axios.post(apiCall(url), data, token)

export const axiosDownload = (url) => {
  return axios({
    url,
    method: 'GET',
    responseType: 'blob',
  }).then((response) => {
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', 'export_data.xls');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });
}

axios.interceptors.response.use((res) => res,  error => {
  if (error.response.status === 403) {
    removeToken()
      .then(() => {
        store.dispatch({ type: types.UNAUTH_USER })
        store.dispatch({type: types.AUTH_ERROR,payload:error.response.data.message})
        history.push('/login')
      })
  }
  return Promise.reject(error)
});
