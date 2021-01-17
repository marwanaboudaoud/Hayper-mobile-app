import React from "react";
import { Ring } from 'react-spinners-css';

function Btn(props) {
  return (
    <button
      disabled={typeof(props.disabled) !== 'undefined' ? props.disabled : false}
      form={props.form}
      type={props.typeOf}
      className={(props.second ? props.second ? ' button-secondary' : ' ': ' ') + (props.disabled ? ' button-disabled ' : '')}
      onClick={props.onClick}
      className={`${props.type} btn`}
      to={props.path}
    >
      <div>{props.loading ? <Ring className={'pure-spinner'} size={props.size ? props.size : 20} color={props.spinnerColor ? props.spinnerColor : 'white'}/> : props.children}</div>
    </button>
  );
}

export default Btn;
