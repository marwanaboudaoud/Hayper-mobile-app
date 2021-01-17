import * as types from '../actions/types'

const initialState = {
    nationalities :[],
    loading:true,
};

export const nationalityReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_NATIONLITIES:
            return { ...state, nationalities:payload, loading:false};
            default:
            return state;

    }
};