import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';
import store from '../utils/Store';

export const getEmployees = (date,is_driver,shift) => (dispatch) => {
    const data ={date,is_driver,availability_shift_id:shift}
    getToken()
    .then(({token}) => {
        axiosPOST('availabilities/search',data,getHeader(token))
        .then(({data:{data}}) => {
            dispatch({type: types.GET_EMPLOYEE, payload:data})
        })
        .catch(e => console.log(e))
    })
};

export const fetchEmployee = payload => (dispatch) => {
    getToken()
        .then(({token}) => {
            axiosGET(`employees/${payload}`,getHeader(token))
                .then(({data}) => {
                    dispatch({type: types.GET_EMPLOYEE, payload:data})
                })
                .catch(e => console.log(e))
        })
};

export const resetEmployees = () => dispatch => {
   return dispatch({type: types.RESET_EMPLOYEES})
}

export const resetEmployee = () => dispatch => {
    return dispatch({type: types.RESET_EMPLOYEE})
 }

export const searchEmployees = search => dispatch => {
    return dispatch({type: types.FILTER_EMPLOYEES, payload:search})
    }


export const addToForm = payload => dispatch => {
    dispatch({type:types.ADD_EMPLOYEE_FORM,payload})
}

export const createEmployee = (payload) => (dispatch) => {
    const res = {...payload,income_tax: payload.income_tax === 'true' ? true : false , contract:{...payload.contract, document_number: payload.document_number}};
    getToken()
    .then(({token}) => {
        axiosPOST('employees/store',res,getHeader(token))
        .then(({data}) => {
            console.log(data);
            history.push('/medewerkers')
        })
        .catch(e => console.log(e.response.data))
    })
};

export const addTag = id => dispatch => {
    console.log(id)
    const {projects:{projects}} = store.getState();
    const project = projects.find(x => x.id == id);
    const newProjects = projects.map((el) => el.id === project.id ? {...project, hidden:true} : el);
    dispatch({type:types.FETCH_PROJECTS, payload:newProjects})
    dispatch({type: types.ADD_EMPLOYEE_TAG, payload:project});

};

export const removeTag = id => dispatch => {
    const {projects:{projects}} = store.getState();
    const project = projects.find(x => x.id == id);
    const newProjects = projects.map((el) => el.id === project.id ? {...project, hidden:false} : el);
    dispatch({type:types.FETCH_PROJECTS, payload:newProjects})
    dispatch({type: types.REMOVE_EMPLOYEE_TAG, payload:project.id});
};

export const getEmployee = id => (dispatch) => {
    dispatch({type: types.LOAD_EMPLOYEE_FORM});
    getToken()
        .then(({token}) => {
            axiosGET(`employees/${id}`,getHeader(token))
                .then(({data}) => {
                    dispatch({type: types.GET_EMPLOYEE_FORM, payload:data})
                })
                .catch(e => console.log(e))
        })
};


export const getEmployeeFormData = string => dispatch => {
    const {employees:{employeeFormData}} = store.getState();
    const value = string.split('.');
    if(value.length === 1){
        return employeeFormData[value]
    } 
    if(value.length === 2){
       const base =  employeeFormData[`${value[0]}`];
         return base ? base[`${value[1]}`] : '';
    }
    return '';
};  

export const updateEmployee = data => dispatch => {
    const payload = {...data, role: data.role.id}
    console.log(payload);
    dispatch({type:types.TOGGLE_FORM_LOADING});
    getToken()
    .then(({token}) => {
        axiosPOST(`employees/${data.id}/update`,payload,getHeader(token))
        .then((data) => {
            dispatch({type:types.TOGGLE_FORM_LOADING});
            console.log(data);
            history.push('/medewerkers')
        })
        .catch(e =>  dispatch({type:types.TOGGLE_FORM_LOADING}))
    })
}