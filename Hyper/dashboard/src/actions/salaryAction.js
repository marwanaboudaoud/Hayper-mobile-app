import { UPLOAD_SALARY, FINISH_SALARY, REMOVE_SALARY, FETCH_SALARY } from './types';
// import history from '../utils/history';
import { axiosGET, axiosPOST, getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';


export const uploadSalary = (id, payload) => dispatch => {
    dispatch({ type: UPLOAD_SALARY, payload })
    const formData = new FormData();
    formData.append('date', payload.date)
    formData.append('description', payload.description);
    formData.append('price', payload.price);
    getToken()
        .then(({ token }) => {
            axiosPOST(`salaries-manual/${id}/store`, formData, getHeader(token, { 'content-type': 'multipart/form-data' }))
                .then(({ data }) => {
                    axiosGET(`salaries/${id}`, getHeader(token))
                        .then(({ data: { data } }) => {
                            dispatch({ type: FETCH_SALARY, payload: data })
                        })
                        .catch(e => console.log(e))
                })
                .catch(e => dispatch({ type: FINISH_SALARY, payload: false }))
        })
};


export const removeSalary = (id) => dispatch => {
    dispatch({ type: REMOVE_SALARY, payload: id })
    getToken()
        .then(({ token }) => {
            axiosPOST(`salaries-manual/${id}/delete`, {}, getHeader(token))
                .then(({ data: { data } }) => {
                })
                .catch(e => dispatch({ type: FINISH_SALARY, payload: false }))
        })
};


export const fetchSalary = (id) => dispatch => {
    getToken()
        .then(({ token }) => {
            axiosGET(`salaries/${id}`, getHeader(token))
                .then(({ data: { data } }) => {
                    dispatch({ type: FETCH_SALARY, payload: data })
                })
                .catch(e => console.log(e))
        })
};

