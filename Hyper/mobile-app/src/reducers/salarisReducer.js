

import { getWeek, getThisMonth } from "../utils/Date";
import { UPDATE_SALARIS_DATE_MONTH, UPDATE_AVAILABILITY_DATE, FETCH_SALARIS, UPDATE_SCHEDULE_CURRENTDAY, SEND_SALARIS, FINISH_SALARIS, ERROR_SALARIS } from "../actions/types";


const initialState = {
    date: getWeek(0),
    monthLoading: false,
    salaries: [],
    fetchLoading: true,
    loading: false,
    errorMessage: '',
    currentDay: '',
    monthDate: getThisMonth(0)
};


export const salarisReducer = (state = initialState, { type, payload }) => {
    switch (type) {
        case UPDATE_SALARIS_DATE_MONTH:
            return { ...state, monthDate: getThisMonth(payload), monthLoading: true }
        case UPDATE_AVAILABILITY_DATE:
            return { ...state, date: getWeek(payload), salaries: [], loading: true };
        case FETCH_SALARIS:
            return { ...state, salaries: payload, loading: false, monthLoading: false }
        case UPDATE_SCHEDULE_CURRENTDAY:
            return { ...state, currentDay: payload }
        case SEND_SALARIS:
            return { ...state, loading: true, error: false };
        case FINISH_SALARIS:
            return { ...state, loading: false, finished: true }
        case ERROR_SALARIS:
            return { ...state, loading: false, error: true, finished: false, errorMessage: payload }
        default:
            return state;
    }
};
