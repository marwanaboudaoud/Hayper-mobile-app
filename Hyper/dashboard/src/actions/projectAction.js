import {ERROR_PROJECTS,FETCH_PROJECTS,FETCH_PROJECT,RESET_PROJECT, UPDATE_PROJECT_DATE,SET_PROJECT_FINISHED,ADD_SCHEDUELE, RESET_PROJECTS,SET_FINISHED_PARTNERS,SET_LOADING_PARTNERS} from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';

export const fetchProjects = payload => (dispatch) => {
    getToken()
    .then(({token}) => {
        axiosPOST('schedules/',payload,getHeader(token))
        .then(({data:{data}}) => {
             dispatch({type: FETCH_PROJECTS, payload:data})
        })
        .catch(e => dispatch({type: ERROR_PROJECTS}));
    })
};

export const fetchAllProjects = () => (dispatch) => {
    const payload ={
        "page": "1",
        "limit": "10000",
        "order_by": "id",
        "direction": "asc",
        "search": {
          "name": "",
          "active": "",
          "partner_id": ""
        }
      }
    getToken()
    .then(({token}) => {
        axiosPOST('projects/',payload,getHeader(token))
        .then(({data:{results}}) => {
            dispatch({type: FETCH_PROJECTS, payload:results})
        })
        .catch(e => console.log(e))
    })
};

export const updateProjectDate = (date,setter) => dispatch => {
   return dispatch({type: UPDATE_PROJECT_DATE, payload:{date,setter}})
};

export const addScheduleToProject = payload => dispatch => {
    getToken()
    .then(({token}) => {
        axiosPOST('schedules/store',{items:[payload]},getHeader(token))
        .then(({data:{items}}) => {
            const item = items[0];
            dispatch({type: RESET_PROJECTS})
        })
        .catch(e => console.log(e))
    })
};

export const removeScheduleFromProject = (id) => dispatch => {
    getToken()
    .then(({token}) => {
        axiosPOST(`schedules/${id}/delete`,null,getHeader(token))
        .then(() =>  dispatch({type: RESET_PROJECTS}))
        .catch(e => console.log(e))
    })
}

export const updateScheduleOfProjects = (id,payload) => dispatch => {
    getToken()
    .then(({token}) => {
        axiosPOST(`schedules/${id}/update`,payload,getHeader(token))
        .then(() =>  dispatch({type: RESET_PROJECTS}))
        .catch(e => console.log(e))
    })
}

export const storeProject = payload => dispatch => {
    dispatch({type:SET_LOADING_PARTNERS})
    getToken()
    .then(({token}) => {
        axiosPOST(`projects/store`,payload,getHeader(token))
        .then(() => {
            dispatch({type:SET_FINISHED_PARTNERS})
            history.goBack()})
        .catch(e => console.log(e))
    })
}

export const getProject = id => dispatch => {
    dispatch({type:RESET_PROJECT})
  const payload =  {
        "page": "1",
        "limit": "1",
        "order_by": "id",
        "direction": "asc",
        "search": {
            "id": id,  
        }
      }

    getToken()
    .then(({token}) => {
        axiosPOST(`projects`,payload,getHeader(token))
        .then(({data:{results}}) => {
            const payload = results[0];
            dispatch({type:FETCH_PROJECT,payload})
        })
        .catch(e => console.log(e))
    })
}

export const setProjectFinished = () => dispatch => {
    dispatch({type:SET_PROJECT_FINISHED})
};

export const setProjectLoading = () => dispatch => {
    dispatch({type:SET_LOADING_PARTNERS})
};

export const resetProject = () => dispatch => {
    dispatch({type:RESET_PROJECT})
}

export const updateProject = (payload,id) => dispatch => {
    getToken()
    .then(({token}) => {
        axiosPOST(`projects/${id}/update`,payload,getHeader(token))
        .then(({data:{results}}) => {
                dispatch({type:SET_PROJECT_FINISHED})
                history.push('/beheren/projecten')

        })
        .catch(e => console.log(e))
    })
};