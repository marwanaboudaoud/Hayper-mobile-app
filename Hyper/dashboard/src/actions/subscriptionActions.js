import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST,getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';

export const storeSubscription = payload => (dispatch) => {
    dispatch({type:types.SET_FETCH_SUBSCRIPTION})
    getToken()
    .then(({token}) => {
        axiosPOST('subscriptions/store',payload,getHeader(token))
        .then(res => {
            dispatch({type:types.SET_UNFETCH_SUBSCRIPTION})
            history.push('/beheren/abonnementen');
        })
        .catch(e =>  dispatch({type:types.SET_UNFETCH_SUBSCRIPTION}))
    })
};

export const fetchSubscription = id => dispatch =>  {
    dispatch({type:types.SET_LOADING_SUBSCRIPTION})
    const payload = {
        "page": "1",
        "limit": "1",
        "order_by": "id",
        "direction": "asc",
        "search": {
          "id": parseInt(id),
          "project": "",
          "code": "",
          "duration_in_months": "",
          "title": ""
        }
      };

    getToken()
    .then(({token}) => {
        axiosPOST('subscriptions',payload,getHeader(token))
        .then(({data:{results}}) => {
            const payload = results[0];
            dispatch({type:types.FETCH_SUBSCRIPTION, payload})
    
        })
        .catch(e => console.log(e))
    })
};

export const setSubscriptionFinished = () => dispatch =>  {
    dispatch({type:types.SET_FINISHED_SUBSCRIPTION})
};

export const resetSubscription = () => dispatch =>  {
    dispatch({type:types.RESET_SUBSCRIPTION})
};

export const updateSubscription = (payload,id) => dispatch => {
    dispatch({type:types.SET_FETCH_SUBSCRIPTION})
    getToken()
    .then(({token}) => {
        axiosPOST(`subscriptions/${id}/update`,payload,getHeader(token))
        .then(res => {
            dispatch({type:types.SET_UNFETCH_SUBSCRIPTION})
            history.goBack();
        })
        .catch(e => console.log(e))
    })
};