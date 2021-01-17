import { UPDATE_AVAILABILITY_SCHEDULES, RESET_AVAILABILITY, ERROR_AVAILABILITY, UPDATE_AVAILABILITY_DATE, FETCH_AVAILABILITY, UPDATE_AVAILABILITY_CURRENTDAY, SEND_AVAILABILITY, FINISH_AVAILABILITY } from "../actions/types";
import { getWeek } from "../utils/Date";


const initialState = {
    date: getWeek(0),
    mySchedules: [],
    fetchLoading: true,
    loading: false,
    errorMessage: '',
    currentDay: ''
};

export const availabilityReducer = (state = initialState, { type, payload }) => {
    switch (type) {
        case RESET_AVAILABILITY:
            return { ...state, fetchLoading: false, loading: false, error: false, finished: false, errorMessage: '' }
        case UPDATE_AVAILABILITY_DATE:
            return { ...state, date: getWeek(payload), mySchedules: [], fetchLoading: true };
        case FETCH_AVAILABILITY:
            return { ...state, mySchedules: payload, fetchLoading: false, }
        case UPDATE_AVAILABILITY_CURRENTDAY:
            return { ...state, currentDay: payload }
        case SEND_AVAILABILITY:
            return { ...state, loading: true, error: false };
        case FINISH_AVAILABILITY:
            return { ...state, loading: false, finished: true }
        case UPDATE_AVAILABILITY_SCHEDULES:
            return { ...state, mySchedules: payload, finished: true }
        case ERROR_AVAILABILITY:
            return { ...state, loading: false, error: true, finished: false, errorMessage: payload }
        default:
            return state;
    }
};
