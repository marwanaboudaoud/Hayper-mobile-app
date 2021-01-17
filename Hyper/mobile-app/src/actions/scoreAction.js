import { FETCH_SCORE } from './types';
import { axiosPOST, getHeader } from '../utils/axios';
import { getToken } from '../utils/helpers';



export const fetchMyScore = data => dispatch => {
    getToken()
        .then(({ token }) => {
            axiosPOST('my-score', data, getHeader(token))
                .then(({ data: { results } }) => {
                    dispatch({ type: FETCH_SCORE, payload: results })
                })
                .catch(e => console.log(e))
        })
        .catch(() => fetchMyScore())
};

