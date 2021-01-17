import React from "react";
import styles from "./index.module.scss";

function Input({ type, name, value, onChange, rightIcon, label }) {
  return (
    <div className={styles.inputBlock}>
      <label className={styles.label}>{label}</label>
      <input
        className={styles.input}
        type={type}
        name={name}
        value={value}
        onChange={onChange}
      />
      {rightIcon && <div className={styles.iconRight}>{rightIcon}</div>}
    </div>
  );
}

export default Input;
