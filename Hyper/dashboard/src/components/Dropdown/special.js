import React, { useEffect,useState } from 'react';

function Dropdown({ defaultValue,label, options, name, onChange, value, disabled , required}) {
    const [currentValue, updateCurrentValue] = useState(0);
    const disabledClass = disabled ? 'disabled' : '';
    const mappedOptions = options.map((option, i) => {
        return option.hidden === true ? '' : <option key={i} selected={option.isDefault && option.isDefault === true ? true : false} disabled={option.disabled === true ? true : false} value={option.value ? option.value : option.id}>{option.name ? option.name : option.title}</option>
    });

    useEffect(() => {
        if(options.length > 0){
            console.log(options)
            updateCurrentValue(options[0])
            onChange(name,options[0].value)
        }
    },[options])



    return (
        <div className='input-block select'>
            <label className={`${disabledClass} label`}>{label}</label>
            <select defaultValue={defaultValue} required={required} className={'input select'} name={name} onChange={(event) =>{
                 onChange(event.target.name, event.target.value)
                 updateCurrentValue(event.target.value);
            }
            } disabled={disabled} value={currentValue}>
                {mappedOptions}
            </select>

        </div>
    );
}

export default Dropdown;