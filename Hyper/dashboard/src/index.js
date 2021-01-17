import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import * as serviceWorker from './serviceWorker';

import './assets/css/bootstrap.css';
import './assets/scss/index.scss';

ReactDOM.render(<App />, document.getElementById('root'));

serviceWorker.unregister();
