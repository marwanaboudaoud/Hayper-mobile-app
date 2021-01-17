import { UPDATE_SCHEDULE_DATE, FETCH_SCHEDULES, UPDATE_SCHEDULE_CURRENTDAY } from './types';
import { axiosPOST, getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';

export const fetchMySchedules = data => dispatch => {
    getToken()
        .then(({ token }) => {
            axiosPOST("my-schedule", data, getHeader(token))
                .then(({ data: { results } }) => {
                    dispatch({ type: FETCH_SCHEDULES, payload: results })
                })
                .catch(e => console.log(e))
        })
        .catch(() => fetchMySchedules())
};




export const updateCalendarDate = count => dispatch => {
    getToken()
        .then(() => {
            dispatch({ type: UPDATE_SCHEDULE_DATE, payload: count })
        })
};

export const updateCurrentDay = (day) => dispatch => {
    getToken()
        .then(() => {
            dispatch({ type: UPDATE_SCHEDULE_CURRENTDAY, payload: day })
        })
};