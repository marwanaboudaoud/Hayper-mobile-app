import * as types from '../actions/types'

const initialState = {
    countries :[],
    loading:true,
};

export const countriesReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_COUNTRIES:
            return { ...state, countries:payload, loading:false};
            default:
            return state;

    }
};