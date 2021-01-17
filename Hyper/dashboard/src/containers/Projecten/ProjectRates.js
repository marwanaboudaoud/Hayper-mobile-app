import React, {useEffect, useState} from 'react'
import Input from '../../components/Input';
import { removeItemByIndex, updateItemByIndex } from '../../utils/helpers';
import RedCross from '../../assets/img/icons/red-cross.svg'
import Dropdown from "../../components/Dropdown";
import {withRouter} from "react-router";
import {connect} from "react-redux";
import {fetchRoles} from "../../actions/rolesActions";


const ProjectRates = ({data, updateData, fetchRoles, roles}) => {
    const [currentRoles, setCurrentRoles] = useState(roles);

    useEffect(() => {
        fetchRoles()
    },[]);

    return data.map((d,i) => (
        <React.Fragment key={i}>
            <div className="col-xs-3">
                <Input required value={d.rate || ''}  label={'Aantal inschrijving'} type={'number'} name={'rate'}  onChange={(n,v)=> updateData(updateItemByIndex(data,i,n,v))} />
            </div>
            <div className="col-xs-3">
                <Input required value={d.amount || ''}  label={'Bedrag'} type={'number'} name={'amount'}  onChange={(n,v)=> updateData(updateItemByIndex(data,i,n,v))} />
            </div>
            <div className="col-xs-5">
                <Dropdown defaultValue={d.role_id || 1} required name={'role_id'} label={'Functie'} onChange={(n,v)=> updateData(updateItemByIndex(data,i,n,v))} options={roles} />
            </div>
            <div className="col-xs-1">
                <div className="project__button-wrap">
                    <button type={'button'} onClick={() => updateData(removeItemByIndex(data,i))} className="project__button-remove">
                        <img src={RedCross}/>
                    </button>
                </div>
            </div>
        </React.Fragment>
    ));
}

const mapStateToProps = state => ({
    roles: state.roles.roles
});

export default withRouter(connect(mapStateToProps,{fetchRoles})(ProjectRates))
