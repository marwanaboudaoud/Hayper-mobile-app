import { createStore, applyMiddleware, compose } from "redux";
import thunk from "redux-thunk";
import rootReducer from "../reducers";
import history from "./history";
import { detectRuntime } from '../utils/helpers';
const initialState = {};

const middleware = [thunk];

const store = createStore(
  rootReducer(history),
  initialState,
  compose(
    applyMiddleware(...middleware),
    detectRuntime(window.__REDUX_DEVTOOLS_EXTENSION__ ? window.__REDUX_DEVTOOLS_EXTENSION__() : compose, compose)
  )
);
export default store;
