import * as types from '../actions/types'

const initialState = {
   loading: true,
   fetching:false,
   partners:[],
   error: '',
   partner:{},
};

export const partnersReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_PARTNERS:
            return { ...state, error: '', partners: payload, loading:false };
        case types.FETCH_PARTNER:
            return {...state, error: '', partner:payload, loading:false};
        case types.SET_LOADING_PARTNERS:
            return {...state , loading:true}
        case types.RESET_PARTNER:
            return {...state, partner: {},loading:true}
        case types.SET_FINISHED_PARTNERS:
            return {...state, loading:false}
        case types.FETCHING_PARTNERS:
            return {...state,fetching:true}
        case types.UNFETCHING_PARTNERS:
            return {...state,fetching:false}
            default:
            return state;

    }
};