import { UPDATE_SCHEDULE_DATE, FETCH_SCHEDULES, UPDATE_SCHEDULE_CURRENTDAY } from "../actions/types";
import { getWeek } from "../utils/Date";

const initialState = {
  date: getWeek(0),
  schedules: [],
  loading: true,
  currentDay: ''
};

export const scheduleReducer = (state = initialState, { type, payload }) => {
  switch (type) {
    case UPDATE_SCHEDULE_DATE:
      return { ...state, date: getWeek(payload), schedules: [], loading: true };
    case FETCH_SCHEDULES:
      return { ...state, schedules: payload, loading: false, }
    case UPDATE_SCHEDULE_CURRENTDAY:
      return { ...state, currentDay: payload }
    default:
      return state;
  }
};
