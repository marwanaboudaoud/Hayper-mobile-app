import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';
import store from '../utils/Store';

export const fetchRoles = () => (dispatch) => {
    const payload={
        "page": "1",
        "limit": "1000",
        "order_by": "id",
        "direction": "asc",
        "search": {
        }
      }
    getToken()
    .then(({token}) => {
        axiosPOST('roles',payload,getHeader(token))
        .then(({data:{results}}) => {
            dispatch({type: types.FETCH_ROLES,payload: results})
        })
        .catch(e => console.log(e))
    })
};

export const createRole = payload => dispatch => {
    dispatch({type:types.SET_FETCH})
    getToken()
    .then(({token}) => {
        axiosPOST('roles/store',payload,getHeader(token))
        .then(({data:{results}}) => {
            dispatch({type:types.STOP_FETCH})
            history.push('/beheren/functies')
        })
        .catch(e => dispatch({type:types.STOP_FETCH}))
    })
};

export const fetchRole = id => dispatch => {
    const {role} = store.getState();
    if(parseInt(id) !== parseInt(role.role.id)){
        dispatch({type: types.ROLE_LOADING})
        getToken()
        .then(({token}) => {
            axiosGET(`roles/${id}`,getHeader(token))
            .then(({data}) => {
                console.log(data)
                dispatch({type:types.FETCH_ROLE,payload:data})
            })
            .catch(e => dispatch({type:types.STOP_FETCH}))
        })
    }

};

export const updateRole = payload => dispatch => {
    dispatch({type:types.FETCHING_ROLE})
    getToken()
    .then(({token}) => {
        axiosPOST(`roles/${payload.id}/update`,payload,getHeader(token))
        .then(({data:{results}}) => {
          setTimeout(() =>{
            dispatch({type:types.STOPPED_ROLE})
            history.push('/beheren/functies')
          },1000)
        })
        .catch(e => dispatch({type:types.STOPPED_ROLE}))
    })
}