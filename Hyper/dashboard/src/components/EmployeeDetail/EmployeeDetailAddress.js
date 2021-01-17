import React, { useState, useEffect } from 'react'
import Input from '../Input';
import { connect } from 'react-redux';
import { addToForm, getEmployeeFormData } from '../../actions/employeeActions';
import Blocktab from '../Blocktab/Blocktab';
import { If, Then, Else } from 'react-if';
import Spinner from '../Spinner'

const EmployeeDetailAddress = ({ addToForm, getEmployeeFormData, dataLoading }) => {
    const [address, updateAddress] = useState({})

    useEffect(() => {
        addToForm({ address: address })
    }, [address]);

    return (
        <Blocktab title={'Adresgegevens'}>
            <If condition={dataLoading}>
                <Then>
                    <Spinner />
                </Then>
                <Else>
                    <div className="col-xs-6">
                        <Input defaultValue={getEmployeeFormData('address.street')} label={'Straat *'} type={'text'} name={'street'} onChange={(n, v) => updateAddress({ ...address, [n]: v })} required />
                    </div>
                    <div className="col-xs-3">
                        <Input defaultValue={getEmployeeFormData('address.house_number')} label={'Huisnummer *'} type={'number'} name={'house_number'} onChange={(n, v) => updateAddress({ ...address, [n]: v })} required />
                    </div>
                    <div className="col-xs-3">
                        <Input defaultValue={getEmployeeFormData('address.addition')} label={'Toevoeging'} type={'text'} name={'addition'} onChange={(n, v) => updateAddress({ ...address, [n]: v })} />
                    </div>
                    <div className="col-xs-6">
                        <Input defaultValue={getEmployeeFormData('address.postcode')} label={'Postcode'} type={'text'} name={'postcode'} onChange={(n, v) => updateAddress({ ...address, [n]: v })} />
                    </div>
                    <div className="col-xs-6">
                        <Input defaultValue={getEmployeeFormData('address.city')} label={'Plaats *'} type={'text'} name={'city'} onChange={(n, v) => updateAddress({ ...address, [n]: v })} required />
                    </div>
                </Else>
            </If>
        </Blocktab>
    )
};
const mapStateToProps = state => ({
    dataLoading: state.employees.employeeFormLoad,
})

export default connect(mapStateToProps, { addToForm, getEmployeeFormData })(EmployeeDetailAddress);
