import {LOAD_AUTH,AUTH_USER,FETCH_USER,UNAUTH_USER,AUTH_ERROR,AFTER_AUTHERROR, AUTH_MESSAGE}from '../actions/types'
const initialState = {
    user:[],
    authenticated:false,
    error:[],
    message: '',
    fetching: false,
};
export const authReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case LOAD_AUTH:
            return {...state, fetching:true}
        case AUTH_USER:
            return { ...state, error: [], authenticated: true, user:payload };
        case FETCH_USER:
            return { ...state, error: [], authenticated: true, fetching:false , user:payload};
        case UNAUTH_USER:
            return { ...state, authenticated: false , user:false };
        case AUTH_ERROR:
            return { ...state, fetching:false,error: payload };
        case AUTH_MESSAGE:
            return { ...state,fetching:false, error: [], message:payload };
        case AFTER_AUTHERROR:
            return { ...state, fetching:false,error: [],message:''};
            default:
            return state;

    }
};