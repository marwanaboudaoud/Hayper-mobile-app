import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';

export const storePartners = payload => (dispatch) => {
    dispatch({type:types.FETCHING_PARTNERS})
    getToken()
    .then(({token}) => {
        axiosPOST('partners/store',payload,getHeader(token))
        .then(res => {
            dispatch({type:types.UNFETCHING_PARTNERS})
            history.push('/beheren/klanten');
        })
        .catch(e => dispatch({type:types.UNFETCHING_PARTNERS}))
    })
};

export const updatePartners = (payload,id) => (dispatch) => {
    dispatch({type:types.FETCHING_PARTNERS})
    getToken()
    .then(({token}) => {
        axiosPOST(`partners/${id}/update`,payload,getHeader(token))
        .then(res => {
            dispatch({type:types.UNFETCHING_PARTNERS})
            history.push('/beheren/klanten');
        })
        .catch(e => dispatch({type:types.UNFETCHING_PARTNERS}))
    })
};

export const getPartner = id => dispatch => {
    dispatch({type:types.SET_LOADING_PARTNERS})
    getToken()
    .then(({token}) => {
        axiosGET(`partners/${id}`,getHeader(token))
        .then(({data:{partner}}) => {
            dispatch({type:types.FETCH_PARTNER,payload:partner})
        })
        .catch(e => console.log(e))
    })
};

export const resetPartner = () => dispatch => {
    dispatch({type:types.RESET_PARTNER})
};

export const setPartnerFinished = () => dispatch => {
    dispatch({type:types.SET_FINISHED_PARTNERS})
}

export const fetchAllPartners = () => (dispatch) => {
    const payload = {    
        "page": "1",
        "limit": "10000",
        "order_by": "id",
        "direction": "asc",
        "search": {
            "name": "",
            "address": "",
            "house_number": "",
            "city": "",
            "phone": ""
        }
    }

    getToken()
    .then(({token}) => {
        axiosPOST('partners/',payload,getHeader(token))
        .then(({data:{results}}) => {
            const res = results.map(({id,name}) => ({value:id,name}))
            dispatch({type:types.FETCH_PARTNERS, payload:res})
        })
        .catch(e => console.log(e))
    })
};