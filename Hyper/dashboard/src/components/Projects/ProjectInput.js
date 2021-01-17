import React,{useState} from 'react'
import Search from '../../assets/img/icons/search.svg'
import {connect} from 'react-redux';

const ProjectInput = ({submit,value,onChange,placeholder}) => {

        
    return (
        <div className={'project__search '}>
            <div className={"project__group"+ (submit && value === '' ? ' project__group-error ' : ' ')}>
                <img className="project__img" src={Search}/>
                <input onChange={e => onChange(e.target.value)} value={value} type="text" className="project__input" placeholder={placeholder}/>
            </div>
        </div>
    )
}


export default connect(null,{})(ProjectInput);
