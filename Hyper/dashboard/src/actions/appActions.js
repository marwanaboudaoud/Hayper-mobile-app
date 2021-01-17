import store from '../utils/Store'
import * as types from './types';
const {dispatch,getState} = store;

export const updateAppError = error => {
    const randomStr = () => Math.random().toString(36).substring(7);
    dispatch({type:types.UPDATE_ERROR,payload:{error,id:randomStr(),show:true}}) 
}

export const closeError = id => {
    dispatch({type:types.CLOSE_ERROR,payload:id}) 
}