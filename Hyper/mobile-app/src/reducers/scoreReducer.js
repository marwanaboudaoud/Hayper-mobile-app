import { FETCH_SCORE } from "../actions/types";


const initialState = {
    score: [],
    loading: true,
};

export const scoreReducer = (state = initialState, { type, payload }) => {
    switch (type) {
        case FETCH_SCORE:
            return { ...state, score: payload, loading: false, }
        default:
            return state;
    }
};
