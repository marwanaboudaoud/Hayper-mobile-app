import { axiosPOST, getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';
import { UPDATE_SALARIS_DATE_MONTH, FETCH_SALARIS, UPDATE_SALARIS_DATE, UPDATE_SALARIS_CURRENTDAY } from './types';


export const fetchMySalaris = data => dispatch => {
    getToken()
        .then(({ token }) => {
            axiosPOST('my-salaries', data, getHeader(token))
                .then(({ data: { result } }) => {
                    dispatch({ type: FETCH_SALARIS, payload: result })
                })
                .catch(e => console.log(e))
        })
};

export const updateSalarisCalendarDate = count => dispatch => {
    dispatch({ type: UPDATE_SALARIS_DATE, payload: count })
};

export const updateSalarisCurrentDay = (day) => dispatch => {
    dispatch({ type: UPDATE_SALARIS_CURRENTDAY, payload: day })
};

export const updateSalaryDate = date => dispatch => {
    dispatch({ type: UPDATE_SALARIS_DATE_MONTH, payload: date })
};