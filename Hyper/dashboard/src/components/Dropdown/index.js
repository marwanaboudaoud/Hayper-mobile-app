import React,{useEffect} from 'react';

function Dropdown({ label, options, name, onChange, value, disabled,defaultValue }) {
    const disabledClass = disabled ? 'disabled' : '';
    const mappedOptions = options.map((option, i) => (
        <option key={i} selected={option.isDefault && option.isDefault === true ? true : i == 0 ? true : false} value={option.value ? option.value : option.id}>{option.name ? option.name : option.title ? option.title : option.country}</option>
    ));

    useEffect(() => {
        if(typeof(defaultValue !== 'undefined')){
            onChange(name, defaultValue)
        }  
    },[])

    return (
        <div className='input-block select'>
            <label className={`${disabledClass} label`}>{label}</label>
            <select defaultValue={defaultValue} className={'input select'} name={name} onChange={(event) => onChange(event.target.name, event.target.value)} disabled={disabled}>
                {mappedOptions}
            </select>

        </div>
    );
}

export default Dropdown;