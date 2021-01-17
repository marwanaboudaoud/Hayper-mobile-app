import React,{useState}from 'react';
import Routes from "./containers/App/Routes";
import Normalize from "react-normalize";
import {Provider} from 'react-redux';
import history from './utils/history'
import { ConnectedRouter } from 'connected-react-router'
import store from './utils/Store';
import {getToken} from './utils/helpers';
import { AUTH_USER } from './actions/types';
function App() {
  const [loading,setLoading] = useState(true) 
  
  getToken()
  .then(data => {
    store.dispatch({type: AUTH_USER, payload:data.user})
    return setLoading(false)
  })
  .catch(_ => setLoading(false))
  


  return loading ? 'd' :
    <Provider store={store}>
      <ConnectedRouter history={history}>
          <Normalize/>
          <Routes/>
      </ConnectedRouter>
    </Provider>
}

export default App;
