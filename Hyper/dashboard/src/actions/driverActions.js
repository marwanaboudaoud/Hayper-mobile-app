import {UPDATE_EMPLOYEE_SEARCH, SEARCH_EMPLOYEE} from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';

export const driverActions = payload => (dispatch) => {
    const data ={search :payload}
    return 1;
    // getToken()
    // .then(({token}) => {
    //     axiosPOST('employees/',1,getHeader(token))
    //     .then(({data}) => {
    //         console.log(data);
    //         dispatch({type: SEARCH_EMPLOYEE, payload:data})
    //     })
    //     .catch(e => console.log(e))
    // })
};

export const updateProjectDate = (date,setter) => dispatch => {

   return dispatch({type: UPDATE_EMPLOYEE_SEARCH})
}