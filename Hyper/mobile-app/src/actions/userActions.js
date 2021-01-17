import { setToken, removeToken } from "../utils/helpers";
import {
  AUTH_USER,
  AUTH_ERROR,
  UNAUTH_USER,
  AUTH_MESSAGE,
  LOAD_AUTH,
  AFTER_AUTHERROR
} from "./types";
import history from "../utils/history";
import { axiosPOST } from "../utils/axios";

export const login = payload => dispatch => {
  dispatch({ type: LOAD_AUTH })
  axiosPOST("login", payload)
    .then(({ data }) => {
      setToken(data).then(() => {
        dispatch({ type: AUTH_USER, payload: data.user });
        return history.push("/weekplanning");
      })

    })
    .catch(e => dispatch({ type: AUTH_ERROR, payload: 'Er is iets fouts gegaan probeer het later opnieuw' }));
};

export const signOut = () => dispatch => {
  removeToken();
  dispatch({
    type: UNAUTH_USER
  });
};

export const requestPassword = email => dispatch => {
  dispatch({ type: LOAD_AUTH })
  const host = process.env.REACT_APP_HOST;
  axiosPOST("forgot-password", { email, host })
    .then(({ data: { message } }) => {
      dispatch({ type: AUTH_MESSAGE, payload: 'Bekijk uw email voor de link' });
      setTimeout(() => {
        dispatch({ type: AUTH_MESSAGE, payload: "" });
        return history.push('/login');
      }, 3000)
    })
    .catch(e => dispatch({ type: AUTH_ERROR, payload: 'Er is iets fouts gegaan probeer het later opnieuw' }));
};

export const resetPassword = payload => dispatch => {
  dispatch({ type: LOAD_AUTH })
  axiosPOST("reset-password", payload)
    .then(({ data: { message } }) => {
      dispatch({ type: AUTH_MESSAGE, payload: 'U kunt nu weer inloggen' });
      setTimeout(() => {
        dispatch({ type: AUTH_MESSAGE, payload: '' });
        return history.push("/login");
      }, 1500)
    })
    .catch(e => dispatch({ type: AUTH_ERROR, payload: 'Er is iets fouts gegaan probeer het later opnieuw' }));
};

export const resetAuth = () => dispatch => {
  dispatch({ type: AFTER_AUTHERROR })
}