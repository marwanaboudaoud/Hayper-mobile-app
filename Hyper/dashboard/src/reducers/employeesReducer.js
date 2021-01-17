import * as types from '../actions/types'
import {filterByName} from '../utils/filter';

const initialState = {
   loading:true,
   employees:[],
   filtered:[],
   employee:{},
   error:'',
   employeeFormData:{},
   employeeFormLoad:false,
   updatingFormData:false,
   tags:[],
};

export const employeesReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.GET_EMPLOYEE:
            return { ...state, error: '', data:payload,employees: payload,filtered:payload, loading:false };
        case types.RESET_EMPLOYEES:
            return { ...state, employees:[],filtered:[], loading: true };
        case types.RESET_EMPLOYEE:
            return { ...state, employeeFormData:{}};
        case types.FILTER_EMPLOYEES:
            return {...state , filtered: filterByName(state.employees, payload)}
        case types.ADD_EMPLOYEE_FORM:
            return {...state , employeeFormData:{...state.employeeFormData,...payload} }
        case types.RESET_EMPLOYEE_FORM:
            return {...state , employeeFormData:{}, employeeFormLoad:true}
        case types.LOAD_EMPLOYEE_FORM:
            return {...state , employeeFormLoad:true}
        case types.FINISH_EMPLOYEE_FORM:
            return {...state , employeeFormLoad:false}
        case types.ADD_EMPLOYEE_TAG:
            return {...state, tags:[...state.tags,payload]} 
        case types.REMOVE_EMPLOYEE_TAG:
            return {...state, tags:[...state.tags].filter(el => el.id !== payload)}   
        case types.GET_EMPLOYEE_FORM:
            return {...state, employeeFormData:payload, employeeFormLoad:false}
        case types.TOGGLE_FORM_LOADING:
            return {...state,updatingFormData: !state.updatingFormData}
            default:
            return state;
    }
};