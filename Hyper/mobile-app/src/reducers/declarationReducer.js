import { SEND_DECLARATIONS, FINISH_DECLARATIONS, RESET_DECLARATIONS } from "../actions/types";

const initialState = {
    loading: false,
    error: false,
    finished: false
};

export const declartionReducer = (state = initialState, { type, payload }) => {
    switch (type) {
        case SEND_DECLARATIONS:
            return { ...state, loading: true, error: false };
        case FINISH_DECLARATIONS:
            return { ...state, loading: false, finished: true }
        case RESET_DECLARATIONS:
            return initialState;
        default:
            return state;
    }
};
