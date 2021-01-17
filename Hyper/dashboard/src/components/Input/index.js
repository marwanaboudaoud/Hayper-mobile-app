import React from 'react';

function Input({ label, type, name, onChange, value, rightIcon, disabled, required, defaultValue }) {

    const disabledClass = disabled ? 'disabled' : '';
    return (
        <div className='input-block'>
            <label className={`${disabledClass} label`}>{label}</label>
            <input defaultValue={defaultValue} className='input' type={type} name={name} onChange={(event) => onChange(event.target.name, event.target.value)} value={value} disabled={disabled} required={required} />
            {rightIcon &&
                <div className='icon-right'>
                    {rightIcon}
                </div>
            }
        </div>
    );
}

export default Input;