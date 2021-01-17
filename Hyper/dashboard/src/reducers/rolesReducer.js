import * as types from '../actions/types'

const initialState = {
    loading:true,
    roles: [],
    fetching: false,
    role:{},
};

export const rolesReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_ROLES:
            return {...state, roles: payload, loading:false }
        case types.SET_FETCH:
            return {...state, fetching:true}
        case types.STOP_FETCH:
            return {...state, fetching:false}
            default:
            return state;
    }
};