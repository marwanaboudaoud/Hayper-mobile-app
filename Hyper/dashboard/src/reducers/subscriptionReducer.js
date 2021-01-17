import * as types from '../actions/types'

const initialState = {
   loading: true,
   subscription:{},
   fetching:false,
};

export const subscriptionReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_SUBSCRIPTION:
            return {...state,subscription:payload,loading:false}
        case types.SET_FINISHED_SUBSCRIPTION:
            return {...state,loading:false}
        case types.SET_LOADING_SUBSCRIPTION:
            return {...state,loading:true}  
        case types.RESET_SUBSCRIPTION:
            return {...state,loading:true,subscription:{}}   
        case types.SET_FETCH_SUBSCRIPTION:
            return {...state,fetching:true}
        case types.SET_UNFETCH_SUBSCRIPTION:
            return {...state,fetching:false}
            default:
            return state;

    }
};