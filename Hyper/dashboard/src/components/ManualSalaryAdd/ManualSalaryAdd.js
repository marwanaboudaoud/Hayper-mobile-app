import React, { useState, useEffect } from 'react'
import './ManualSalaryAdd.styles.scss'
import Input from '../Input/index'
import Dropdown from '../Dropdown/index'
import GreenTick from '../../assets/img/icons/green-tick.svg'
import RedCross from '../../assets/img/icons/red-cross.svg'
import Plus from '../../assets/img/icons/plus.svg';
import { connect } from 'react-redux';
import { uploadSalary } from "../../actions/salaryAction";
import { Else, If, Then } from 'react-if'
import CrossIcon from '../../assets/img/icons/red-cross.svg'
import CheckIcon from '../../assets/img/icons/check.svg'
import Spinner from '../Spinner/index'

const ManualSalaryAdd = ({ onHide, salaryId, uploadSalary, loading, finished, isClosed }) => {

    const [date, updateDate] = useState('');
    const [description, updateDescription] = useState('');
    const [amount, updateAmount] = useState('');
    const [error, updateError] = useState(false);

    const handleSubmit = e => {
        e.preventDefault();
        if (date === '' || description === '' || amount === '') {
            updateError(true)
            return null;
        }
        onHide(false);
        updateError(false)

        return uploadSalary(salaryId, { date, description, price: parseFloat(amount) });
    }
    return (
        <If condition={isClosed === false}>
            <div className="row manualSalary no-padding">
                <If condition={error}>
                    <Then>
                        <div style={{
                            display: 'flex',
                            justifyContent: 'center',
                            color: 'red',
                            fontWeight: '500',
                            marginBottom: '10px'
                        }}>
                            <img style={{ width: '10px', marginRight: '10px' }} src={CrossIcon} alt="" />
                            <span>Vul alle velden in.</span>
                        </div>
                    </Then>
                </If>
                <If condition={finished}>
                    <Then>
                        <div style={{
                            display: 'flex',
                            justifyContent: 'center',
                            color: '#47642E',
                            fontWeight: '500',
                            marginBottom: '10px'
                        }}>
                            <img style={{ width: '10px', marginRight: '10px' }} src={CheckIcon} alt="" />
                            <span>Je aanmelding is verstuurd!</span>
                        </div>
                    </Then>
                </If>
                <If condition={loading}>
                    <Then>
                        <div style={{ display: "flex", justifyContent: "center" }}>
                            <Spinner color={"white"} width={40} />
                        </div>
                    </Then>
                    <Else>
                        <div className="col-xs-3">
                            <Input onChange={(name, value) => updateDate(value)} label={'Datum'} type={'date'} name={'Datum-input'} value={date} />
                        </div>
                        <div className="col-xs-5">
                            <Dropdown onChange={(name, value) => updateDescription(value)} name={'Omschrijving'} label={'Omschrijving'} value={description} options={[{ value: 'select', name: 'Selecteer een optie...' }, { value: 'L5101 - Declaraties', name: 'L5101 - Declaraties' }, { value: 'Hyper', name: 'Hyper' }]} />
                        </div>
                        <div className="col-xs-3">
                            <Input onChange={(name, value) => updateAmount(value)} label={'Bedrag'} type={'number'} name={'Bedrag-input'} value={amount} />
                        </div>
                        <div className="col-xs-1 manualSalary__buttons">
                            <button onClick={e => handleSubmit(e)} className="manualSalary__buttons--btn success"><img src={GreenTick}></img></button>
                            <button onClick={e => { e.preventDefault(); onHide() }} className="manualSalary__buttons--btn cancel"><img src={RedCross}></img></button>
                        </div>
                    </Else>
                </If>
            </div>
        </If>
    )
}


const mapStateToProps = state => ({
    loading: state.salary.loading,
    finished: state.salary.finished,
    isClosed: state.salary.salary.is_closed,
});

export default connect(mapStateToProps, { uploadSalary })(ManualSalaryAdd);
