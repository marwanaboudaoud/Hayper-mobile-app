import { SEND_VRIEND_AANMELDEN, FINISH_VRIEND_AANMELDEN } from "../actions/types";

const initialState = {
    loading: false,
    error: false,
    finished: false
};

export const vriendAanmeldenReducer = (state = initialState, { type, payload }) => {
    switch (type) {
        case SEND_VRIEND_AANMELDEN:
            return { ...state, loading: true, error: false };
        case FINISH_VRIEND_AANMELDEN:
            return { ...state, loading: false, finished: true }
        default:
            return state;
    }
};
