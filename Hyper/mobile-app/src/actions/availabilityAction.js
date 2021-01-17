import { RESET_AVAILABILITY, ERROR_AVAILABILITY, FETCH_AVAILABILITY, UPDATE_AVAILABILITY_DATE, UPDATE_AVAILABILITY_CURRENTDAY, SEND_AVAILABILITY, FINISH_AVAILABILITY, UPDATE_AVAILABILITY_SCHEDULES } from './types';
import { axiosPOST, getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';
import store from '../utils/Store';

export const fetchMyAvailability = data => dispatch => {
    getToken()
        .then(({ token }) => {
            axiosPOST('my-availability', data, getHeader(token))
                .then(({ data: { results } }) => {
                    dispatch({ type: FETCH_AVAILABILITY, payload: results })
                })
                .catch(e => console.log(e))
        })
};


export const uploadAvailability = payload => dispatch => {
    dispatch({ type: SEND_AVAILABILITY })
    getToken()
        .then(({ token }) => {
            let payloadWithToken = { ...payload, api_token: token }
            axiosPOST('availabilities/store', payloadWithToken, getHeader(token))
                .then(({ data }) => {
                    dispatch({ type: FINISH_AVAILABILITY, payload: true })
                    const { availability: { mySchedules } } = store.getState()
                    dispatch({ type: UPDATE_AVAILABILITY_SCHEDULES, payload: [...mySchedules, data] })
                })
                .catch(e => dispatch({ type: ERROR_AVAILABILITY, payload: e.response.data.message }))
        })
};

export const updateAvailability = payload => dispatch => {
    dispatch({ type: SEND_AVAILABILITY })
    getToken()
        .then(({ token }) => {
            axiosPOST(`availabilities/${payload.id}/update`, payload, getHeader(token))
                .then(({ data: { items } }) => {
                    const { availability: { mySchedules } } = store.getState()
                    const newSchedules = mySchedules.map(schedule => schedule.id === payload.id ? items : schedule)
                    dispatch({ type: UPDATE_AVAILABILITY_SCHEDULES, payload: newSchedules })
                    dispatch({ type: FINISH_AVAILABILITY })
                })
                .catch(e => dispatch({ type: ERROR_AVAILABILITY, payload: e.response.data.message }))
        })
};


export const updateAvailabilityDate = count => dispatch => {
    dispatch({ type: FINISH_AVAILABILITY })
    dispatch({ type: UPDATE_AVAILABILITY_DATE, payload: count })
};

export const updateCurrentDay = (day) => dispatch => {
    dispatch({ type: UPDATE_AVAILABILITY_CURRENTDAY, payload: day })
};

export const resetAvailability = () => dispatch => {
    dispatch({ type: RESET_AVAILABILITY })
}