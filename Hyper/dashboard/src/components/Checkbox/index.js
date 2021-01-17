import React from 'react'
import './Checkbox.styles.scss'

function Checkbox({ name, label, onChange, value, disabled, checked,defaultValue }) {
    const disabledClass = disabled ? 'disabled-checkbox' : '';
    return (
        <div className="input-block">
            <label className={`${disabledClass} checkbox-container`} htmlFor={name + label} disabled={disabled}>
                <input defaultChecked={defaultValue} className={`${disabledClass} checkbox`} type='checkbox' name={name} id={name + label} onChange={(event) => onChange(event.target.name, event.target.checked)} value={value} disabled={disabled} checked={checked}></input>
                <span className="checkmark">

                </span>
                {label}</label>
        </div>
    )
}
export default Checkbox

