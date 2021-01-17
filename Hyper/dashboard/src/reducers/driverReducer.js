import {SEARCH_EMPLOYEE}from '../actions/types'

const initialState = {
   loading:true,
   drivers:[],
   driver:{},
   error:'',

};

export const driverReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case SEARCH_EMPLOYEE:
            return { ...state, error: '', projects: payload, loading:false };
        // case UPDATE_PROJECT_DATE:
        //     return { ...state, date: payload.date,setter: payload.setter, loading: true };
            default:
            return state;

    }
};