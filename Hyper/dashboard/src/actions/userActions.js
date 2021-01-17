import { setToken, removeToken } from '../utils/helpers';
import { AFTER_AUTHERROR, LOAD_AUTH, AUTH_USER, AUTH_ERROR, FETCH_USER, UNAUTH_USER, AUTH_MESSAGE } from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST } from '../utils/axios';
// import { returnResponse } from '../utils/response';


export const login = payload => dispatch => 
  new Promise((resolve,reject) => {
    dispatch({ type: LOAD_AUTH })
    axiosPOST('login', payload)
        .then(({ data }) => {
            if(data.user.role.id === 1){
            setToken(data)
            .then(() => {
                resolve()
                dispatch({ type: AUTH_USER, payload: data.user })
                return history.push('/dashboard')
            })
        } else {
            return dispatch({ type: AUTH_ERROR, payload: 'Forbidden' })
        }
        })
        .catch(e => {
            reject()
            dispatch({ type: AUTH_ERROR, payload: 'Er is iets fouts gegaan probeer het later opnieuw' })
        })
  })


export const signOut = () => (dispatch) => {
    removeToken()
    dispatch({
        type: UNAUTH_USER
    })
};

export const requestPassword = email => (dispatch) => {
    dispatch({ type: LOAD_AUTH })
    const host = process.env.REACT_APP_HOST;
    axiosPOST('forgot-password', { email, host })
        .then(({ data: { message } }) => {
            dispatch({ type: AUTH_MESSAGE, payload: 'Bekijk uw email voor de link' })
            setTimeout(() => {
                history.push('/login');
                dispatch({ type: AUTH_MESSAGE, payload: '' })
            }, 3000)
        })
        .catch(e => dispatch({ type: AUTH_ERROR, payload: 'Er is iets fouts gegaan probeer het later opnieuw' }))
}

export const resetPassword = payload => (dispatch) => {
    dispatch({ type: LOAD_AUTH })
    axiosPOST('reset-password', payload)
        .then(({ data: { message } }) => {
            dispatch({ type: AUTH_MESSAGE, payload: 'U kunt nu weer inloggen' });
            setTimeout(() => {
                dispatch({ type: AUTH_MESSAGE, payload: '' });
                return history.push("/login");
            }, 1500)
        })
        .catch(e => dispatch({ type: AUTH_ERROR, payload: 'Er is iets fouts gegaan probeer het later opnieuw' }))
}

export const fetchProjects = payload => (dispatch) => {
    axiosPOST('projects', payload)
        .then(({ data }) => {
            setToken(data)
            dispatch({ type: AUTH_USER, payload: data.user })
            return history.push('/dashboard')
        })
        .catch(e => dispatch({ type: AUTH_ERROR }))
};

export const resetAuth = () => dispatch => {
    dispatch({ type: AFTER_AUTHERROR })
}