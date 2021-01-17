import React, { useState, useEffect } from 'react'
import Blocktab from '../Blocktab/Blocktab'
import Input from '../Input'
import { connect } from 'react-redux';
import { addToForm, getEmployeeFormData } from '../../actions/employeeActions';
import { If, Then, Else } from 'react-if';
import Spinner from '../Spinner'

const EmployeeDetailContact = ({ addToForm, getEmployeeFormData, dataLoading }) => {
    const [emergencyContact, updateEmergencyContact] = useState({ "relationship": "Bedrijf" })

    useEffect(() => {
        addToForm({ emergency_contact: emergencyContact })
    }, [emergencyContact]);

    return (
        <Blocktab title={'Contact bij nood'}>
            <If condition={dataLoading}>
                <Then>
                    <Spinner />
                </Then>
                <Else>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('emergency_contact.first_name')} label={'Voornaam *'} type={'text'} name={'first_name'} onChange={(n, v) => updateEmergencyContact({ ...emergencyContact, [n]: v })} required />
                    </div>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('emergency_contact.last_name')} label={'Achternaam *'} type={'text'} name={'last_name'} onChange={(n, v) => updateEmergencyContact({ ...emergencyContact, [n]: v })} required />
                    </div>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('emergency_contact.phone')} label={'Telefoon *'} type={'number'} name={'phone'} onChange={(n, v) => updateEmergencyContact({ ...emergencyContact, [n]: v })} />
                    </div>
                </Else>
            </If>
        </Blocktab>
    )
}
const mapStateToProps = state => ({
    dataLoading: state.employees.employeeFormLoad,
})
export default connect(mapStateToProps, { addToForm, getEmployeeFormData })(EmployeeDetailContact);
