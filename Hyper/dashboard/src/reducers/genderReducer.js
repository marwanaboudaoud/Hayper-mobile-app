import * as types from '../actions/types'

const initialState = {
    genders :[],
    loading:true,
};

export const genderReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.FETCH_GENDERS:
            return { ...state, genders:payload, loading:false};
            default:
            return state;

    }
};