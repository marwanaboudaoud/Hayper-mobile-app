import React from 'react'
import Blocktab from '../Blocktab/Blocktab'
import Input from '../Input';
import Dropdown from '../Dropdown';
import UploadInput from '../UploadInput/UploadInput';
import { connect } from 'react-redux';
import { addToForm, getEmployeeFormData } from '../../actions/employeeActions';
import { If, Then, Else } from 'react-if';
import Spinner from '../Spinner'

const EmployeeDetailFinancial = ({ addToForm, getEmployeeFormData, dataLoading }) => {
    return (
        <Blocktab title={'Financieel'}>
            <If condition={dataLoading}>
                <Then>
                    <Spinner />
                </Then>
                <Else>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('id')} label={'Personeelsnr *'} disabled type={'number'} name={'Personeelsnr-input'} onChange={(e, value) => addToForm({ [e]: value })} required />
                    </div>
                    <div className="col-xs-4">
                        <Input defaultValue={getEmployeeFormData('bsn')} label={'BSN nummer *'} required type={'number'} name={'bsn'} onChange={(e, value) => addToForm({ [e]: value })} required />
                    </div>
                    <div className="col-xs-4">
                        <Dropdown onChange={(e, value) => addToForm({ [e]: value })} name={'ID-dropdown'} label={'ID-type'} options={[{ value: 0, name: 'Geen' }, { value: 1, name: 'Paspoort' }]} />
                    </div>
                    <div className="col-xs-6">
                        <Input label={'Documentnummer'} defaultValue={getEmployeeFormData('document_number')} type={'text'} name={'document_number'} onChange={(e, value) => addToForm({ [e]: value })} />
                    </div>
                    <div className="col-xs-6">
                        <Input label={'Vervaldatum'} defaultValue={getEmployeeFormData('date')} type={'date'} name={'Vervaldatum-input'} onChange={(e, value) => addToForm({ [e]: value })} />
                    </div>
                    <div className="col-xs-12">
                        <UploadInput label={'Kopie ID voorkant'} type={'file'} name={'Kopie-ID-input'} onChange={(e, value) => addToForm({ [e]: value, type: 'file' })} />
                    </div>
                    <div className="col-xs-12">
                        <UploadInput label={'Kopie ID achterkant'} type={'file'} name={'Kopie-ID-input'} onChange={(e, value) => addToForm({ [e]: value })} />
                    </div>
                    <div className="col-xs-6">
                        <Input label={'IBAN nummer *'} defaultValue={getEmployeeFormData('iban')} type={'text'} name={'iban'} onChange={(e, value) => addToForm({ [e]: value })} required />
                    </div>
                    <div className="col-xs-6">
                        <Dropdown name={'income_tax'} label={'Loonheffing'} defaultValue={getEmployeeFormData('income_tax')} onChange={(e, value) => addToForm({ [e]: value })} options={[{ id: true, title: 'Ja' }, { id: false, title: 'Nee' }]} />
                    </div>
                </Else>
            </If>
        </Blocktab>
    )
}

const mapStateToProps = state => ({
    dataLoading: state.employees.employeeFormLoad,
})

export default connect(mapStateToProps, { addToForm, getEmployeeFormData })(EmployeeDetailFinancial)
