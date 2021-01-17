import * as types from '../actions/types'

const initialState = {
    loading: true,
    role:{},
    fetching:false
};

export const roleReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_ROLE:
            return {...state, role:payload, loading:false}
        case types.ROLE_LOADING:
            return {...state, loading:true}
        case types.STOPPED_ROLE:
            return {...state, fetching:false}
            case types.FETCHING_ROLE:
            return {...state, fetching:true}
            default:
            return state;
    }
};