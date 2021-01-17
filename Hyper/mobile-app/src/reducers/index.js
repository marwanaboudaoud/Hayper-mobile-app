import { combineReducers } from "redux";
import { connectRouter } from "connected-react-router";
import { authReducer } from "./authReducer";
import { scheduleReducer } from "./scheduleReducer";
import { declartionReducer } from "./declarationReducer";
import { availabilityReducer } from "./availabilityReducer"
import { vriendAanmeldenReducer } from "./vriendAanmeldenReducer"
import { salarisReducer } from "./salarisReducer";
import { scoreReducer } from "./scoreReducer";

const createRootReducer = history =>
  combineReducers({
    router: connectRouter(history),
    auth: authReducer,
    schedule: scheduleReducer,
    declaration: declartionReducer,
    availability: availabilityReducer,
    signingupmyfriend: vriendAanmeldenReducer,
    salaries: salarisReducer,
    score: scoreReducer
  });

export default createRootReducer;
