import React,{useState,useEffect} from 'react'
import Blocktab from '../Blocktab/Blocktab'
import Input from '../Input'
import {connect} from 'react-redux';
import { addToForm,getEmployeeFormData} from '../../actions/employeeActions';
import { If ,Then,Else} from 'react-if';
import Spinner from '../Spinner'
import { formatToDutch, addMonth } from '../../utils/Date';

const EmployeeDetailContract = ({addToForm,dataLoading,getEmployeeFormData,update}) => {
    const [emergencyContract, updateEmergencyContract] = useState({})
    const [date, updateDate] = useState(false)
    useEffect(() => {
        addToForm({contract: emergencyContract})
    },[emergencyContract]);


    return (
        <Blocktab title={'Contract informatie'}>
             <If condition={dataLoading}>
                <Then>
                    <Spinner/>
                </Then>
                <Else>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('contract.start_date')}  label={'Datum in dienst *'} type={'date'} name={'start_date'} onChange={(n,v) => {
                            updateEmergencyContract({...emergencyContract,[n]:v})
                            updateDate(v)
                        }}  required disabled={update ? 'disabled' : false} />
                    </div>
                    <div className="col-xs-4">
                        <Input  defaultValue={getEmployeeFormData('contract.trial_per_day')} disabled={update ? 'disabled' : false}  type={'number'} onChange={(n,v) => updateEmergencyContract({...emergencyContract,[n]:v})} label={'Begin proeftijd *'} type={'number'} name={'trial_per_day'}/>
                    </div>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('contract.start_date')} disabled label={'Begindatum huidig contract *'} type={'date'} name={'start_present_date'} onChange={(n,v) => updateEmergencyContract({...emergencyContract,[n]:v})} required />
                    </div>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('contract.end_date')}  disabled label={'Einddatum huidig contract *'} type={'date'} name={'end_present_date'} onChange={(n,v) => updateEmergencyContract({...emergencyContract,[n]:v})} required />
                    </div>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('end_date_contract')} disabled label={'Datum uit dienst *'} type={'text'} name={'expiration_date'} onChange={(n,v) => updateEmergencyContract({...emergencyContract,[n]:v})} required />
                    </div>
                </Else>
            </If>
    </Blocktab>

    )
}
const mapStateToProps = state => ({
    dataLoading: state.employees.employeeFormLoad,
})

export default connect(mapStateToProps,{addToForm,getEmployeeFormData})(EmployeeDetailContract)
