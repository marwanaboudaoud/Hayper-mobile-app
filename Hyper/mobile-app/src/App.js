import React, { useState } from 'react'
import 'bootstrap/dist/css/bootstrap.min.css'
import Routes from './containers/App/Routes'
import Normalize from 'react-normalize'
import { Provider } from 'react-redux'
import history from './utils/history'
import { ConnectedRouter } from 'connected-react-router'
import store from './utils/Store'
import { getToken } from './utils/helpers'
import { AUTH_USER } from './actions/types'
import Spinner from './components/Spinner'
function App() {
  const [loading, setLoading] = useState(true)

  getToken()
    .then(data => {
      store.dispatch({ type: AUTH_USER, payload: data.user })
      return setLoading(false)
    })
    .catch(res => setLoading(false))

  return loading ? (
    <div style={{
      display: 'flex', justifyContent: 'center', marginTop: '100px'
    }}>
      <Spinner />
    </div>
  ) : (
      <Provider store={store}>
        <ConnectedRouter history={history}>
          <Normalize />
          <Routes />
        </ConnectedRouter>
      </Provider>
    )
}

export default App
