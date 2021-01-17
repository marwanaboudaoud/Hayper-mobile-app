import React from "react";
import { Link } from "react-router-dom";
import "./index.css";

function Btn(props) {
  return (
    <Link className="primary large btn" to={props.path}>
      <div>{props.children}</div>
    </Link>
  );
}

export default Btn;
