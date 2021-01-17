import { UPLOAD_SALARY, FINISH_SALARY, REMOVE_SALARY, FETCH_SALARY, REPLACE_SALARY } from "../actions/types";

const initialState = {
    loading: true,
    error: false,
    finished: false,
    salary: {},
};

export const salaryReducer = (state = initialState, { type, payload }) => {

    switch (type) {
        case REPLACE_SALARY:

        case UPLOAD_SALARY:
            return {
                ...state,
                salary: {
                    ...state.salary, salary_manual: [
                        ...state.salary.salary_manual,
                        { ...payload }
                    ]
                },
            };
        case FINISH_SALARY:
            return { ...state, loading: false, finished: true, };
        case FETCH_SALARY:
            return { ...state, loading: false, salary: payload }
        case REMOVE_SALARY:
            const newObject = Object.values(state.salary.salary_manual)
                .filter(prop => prop.id !== payload)
            return { ...state, loading: false, salary: { ...state.salary, salary_manual: newObject } }
        default:
            return state;
    }
};
