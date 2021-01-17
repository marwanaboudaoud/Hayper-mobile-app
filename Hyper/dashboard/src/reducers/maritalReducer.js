import * as types from '../actions/types'

const initialState = {
    maritals :[],
    loading:true,
};

export const maritalReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_MARITALS:
            return { ...state, maritals:payload, loading:false};
            default:
            return state;

    }
};