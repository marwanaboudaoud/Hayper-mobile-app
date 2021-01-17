import {ERROR_PROJECTS,RESET_PROJECT,FETCH_PROJECTS,FETCH_PROJECT, UPDATE_PROJECT_DATE,RESET_PROJECTS,SET_PROJECT_FINISHED}from '../actions/types'
import {getCurrentWeek} from '../utils/Date';

const initialState = {
    date:getCurrentWeek(0),
    setter:0,
    projects: [],
    error: '',
    loading: true,
    project:{},
};

export const projectsReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case FETCH_PROJECTS:
            return { ...state, error: '', projects: payload, loading:false };
        case UPDATE_PROJECT_DATE:
            return { ...state, date: payload.date,setter: payload.setter, loading: true };
        case ERROR_PROJECTS:
            return {...state, error:true}
        case RESET_PROJECTS:
            return { ...state, error: '', projects: [],project: {}, loading:true };
        case SET_PROJECT_FINISHED:
            return {...state, loading:false}
        case RESET_PROJECT:
            return {...state, loading:true, project:{}}
        case FETCH_PROJECT:
            return {...state, loading:false, project:payload}
            default:
            return state;

    }
};