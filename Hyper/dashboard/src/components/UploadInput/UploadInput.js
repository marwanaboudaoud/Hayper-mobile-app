import React from 'react';
import './UploadInput.styles.scss'

function UploadInput({ label, type, name, onChange, value, rightIcon, disabled, required, fileName }) {

    const disabledClass = disabled ? 'disabled' : '';
    return (
        <div className='input-block'>
            <label className={`${disabledClass} label`}>{label}</label>
            <input className='input' type={type} name={name} onChange={(event) => onChange(event.target.name, event.target.value)} value={value} disabled={disabled} required={required} />
            {rightIcon &&
                <div className='icon-right'>
                    {rightIcon}
                </div>
            }
            <p className="document-name">{fileName}</p>
        </div>
    );
}

export default UploadInput;