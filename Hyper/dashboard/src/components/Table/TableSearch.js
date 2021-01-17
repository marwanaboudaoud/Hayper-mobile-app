import React, { useState, useEffect } from 'react'
import Search from '../../assets/img/icons/search.svg'
import {connect} from 'react-redux';
import {updateTableSearch,setBodyLoading} from '../../actions/tableActions';
import { translateKeys } from '../../utils/translateKeys';

class TableSearch extends React.Component{
   state = {
       input:'',
       filters:this.props.filters,
       typing:false,
       timout: 0
   }


    handleInputChange (e) {
        e.preventDefault();
        this.props.setBodyLoading()
        let eventValue = e.target.value;
        let eventValueCopy = e.target.value;
        const eventName = e.target.name;
        String.prototype.isNumber = function(){return /^\d+$/.test(this);}
        if(eventValue.isNumber()){
            parseInt(eventValue);
        }
        if(eventValue.toLowerCase() === 'ja') {
            eventValue = "1";
        }
        if(eventValue.toLowerCase() === 'nee') {
            eventValue = "0";
        }
        this.setState({input: eventValueCopy});
        if(this.state.timeout) clearTimeout(this.state.timeout);
        this.state.timeout = setTimeout(() => {
            this.props.updateTableSearch({[eventName]: eventValue})    
        }, 300);
     }

    componentDidUpdate(prevProps){
        if(JSON.stringify(prevProps) !== JSON.stringify(this.props)){
            this.setState({filter:this.props.filter})
        }
    }


    render(){
        const {value,blacklist} = this.props;
        const {input,filters} = this.state;
    return (
        <div className={'table__search'}>
            <div className={"project__group"}>
                <img className="project__img" src={Search}/>
                <form style={{width: '100%'}} onSubmit={e => e.preventDefault()} autoComplete='new-password'>
                <input autoComplete="off" onChange={e => this.handleInputChange(e)} name={value} value={input} type="text" className="project__input" placeholder={translateKeys(value)}/>
                </form>
            </div>
        </div>  
    )
    }
}

const mapStateToProps = state => ({
    filters: state.table.filters,
    table: state.table,
    api: state.table.api,
    blacklist: state.table.blacklist
})

export default connect(mapStateToProps,{updateTableSearch,setBodyLoading})(TableSearch)
