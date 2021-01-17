import * as types from '../actions/types'

const initialState = {
    errors: []
};

export const appReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.UPDATE_ERROR:
            return {...state, errors: [...state.errors, payload]}
        case types.CLOSE_ERROR:
            console.log(payload)
            return {...state, errors: state.errors.filter(er => er.id !== payload)}
            default:
            return state;

    }
};