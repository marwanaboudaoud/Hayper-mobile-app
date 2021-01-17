import React, { useState, useEffect } from 'react'
import './SalaryDetail.styles.scss'
import Layout from '../../components/Layout';
import PageHead from '../../components/PageHead/PageHead';
import Blocktab from '../../components/Blocktab/Blocktab';
import Input from '../../components/Input/index'
import Salary from '../../components/Salary/Salary';
import ManualSalaryRow from '../../components/ManualSalaryRow/ManualSalaryRow'
import ManualSalaryAdd from '../../components/ManualSalaryAdd/ManualSalaryAdd'
import SalaryIndicator from '../../components/SalaryIndicator/SalaryIndicator'
import { connect } from 'react-redux';
import { If, Else, Then } from 'react-if';
import { withRouter } from 'react-router-dom';
import { fetchSalary, removeSalary } from "../../actions/salaryAction";
import Spinner from '../../components/Spinner';
import Moment from 'moment';
import { calculateTotalDays, calculateTotalDaysManual, calculateTotalBonusDay, calculateTotalSalary, calculateTotalAmountDay, calculateTotalDay } from '../../utils/calculate';
import { toDutchValue } from '../../utils/helpers';

const SalaryDetail = ({ history, match, fetchSalary, salary, loading, removeSalary }) => {
    const [isShown, updateIsShown] = useState(false);
    const [salaryId, updateSalaryId] = useState(match.params.id);
    useEffect(() => {
        fetchSalary(match.params.id)

    }, []);

    const salaryDate = Moment(salary.date).format('MM/YYYY')
    const brutoSalaryDate = Moment(salary.date).format('M - YYYY')

    const mapManualSalaries = (salary) => {
        console.log(salary.salary_manual)
        return salary.salary_manual ? salary.salary_manual.map((salaryRow) => {
            const salaryManualDate = Moment(salaryRow.date).format('DD/MM/YYYY')
            return (
                <ManualSalaryRow
                    key={salaryRow.key}
                    date={salaryManualDate}
                    omschrijving={salaryRow.description}
                    bedrag={toDutchValue(salaryRow.price)}
                    id={salaryRow.id}
                />
            )
        }) : [];
    }


    const mapSalaries = (salary) => {
        return salary.salary_days ? salary.salary_days.map((salaryRow, i) => {
            const salaryDayDate = Moment(salaryRow.date).format('DD/MM/YYYY')
            return <Salary
                key={i}
                date={salaryDayDate}
                opdrachtgever={salaryRow.partner}
                gereden={salaryRow.has_driven}
                bedrag={calculateTotalAmountDay(salaryRow).toFixed(2)}
                bonus={calculateTotalBonusDay(salaryRow).toFixed(2)}
                totaalBedrag={calculateTotalDay(salaryRow, ((row) => row)).toFixed(2)}
                expandedDetails={salaryRow.rows}
            />
        }) : [];
    };

    return (
        <div>
            <Layout>
                <If condition={loading} >
                    <Then>
                        <Spinner />
                    </Then>
                    <Else>
                        <div className="PageHeading-top">
                            <PageHead hideSuccesButton={true} title={'Aanvullende salaris regels'} btnTitle={'Opslaan'} onClickCancel={() => history.push('/salaris')} />
                        </div>
                        <form onSubmit={e => e.preventDefault()}>
                            <div className="employee-detail-block__tab">
                                <div className="row">
                                    <div className="col-xs-6">
                                        <Input label={'Medewerker'} type={'text'} name={'Employee-name-input'} disabled value={salary.employee_name} />
                                    </div>
                                    <div className="col-xs-6">
                                        <Input label={'Noodcontact'} type={'text'} name={'Noodcontact-input'} disabled value={salaryDate} />
                                    </div>
                                </div>
                            </div>
                            <Blocktab title={'Aanvullende salaris gegevens'} noPadding>
                                {/* <div className="col-xs-3">
                                    <Input label={'Rubriek'} type={'text'} name={'Rubriek-input'} onChange={() => console.log('test')} disabled value={'C2002'} />
                                </div> */}
                                <div className="col-xs-9">
                                    <Input label={'Omschrijving'} type={'text'} name={'Omschrijving-input'} disabled value={salary.description} />
                                </div>
                                <div className="col-xs-3">
                                    <Input label={'Bedrag'} type={'text'} name={'Bedrag-input'} disabled value={toDutchValue(calculateTotalSalary(salary))} />
                                </div>
                            </Blocktab>
                            <div className="employee-detail-block__tab no-padding">
                                <h2 className="salaryh2Title">Details salaris gegevens</h2>
                                <div className="salaryTableContainer">
                                    <div className="salaryTableContainer__top">
                                        <h3>Datum</h3>
                                        <h3>Opdrachtgever</h3>
                                        <h3>Gereden</h3>
                                        <h3>Aantal</h3>
                                        <h3>Bedrag</h3>
                                        <h3>Bonus</h3>
                                        <h3>Total bedrag</h3>
                                    </div>
                                    <div className="salaryTableContainer__bottom">
                                        {mapSalaries(salary)}
                                        <div className="subtotal">
                                            <p>Subtotal : <span className="subtotal__amount">{toDutchValue(calculateTotalDays(salary))}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="employee-detail-block__tab no-padding">
                                <h2 className="salaryh2Title">Handmatig ingevoerde gegevens</h2>
                                <div className="manualSalaryContainer col-xs-12 no-padding">
                                    <div className="manualSalaryContainer__header">
                                        <h3>Datum</h3>
                                        <h3>Omschrijving</h3>

                                        <h3>Bedrag</h3>

                                    </div>
                                    <div className="manualSalaryContainer__salaries">
                                        {mapManualSalaries(salary)}
                                        <If condition={isShown}>
                                            <ManualSalaryAdd onHide={updateIsShown} salaryId={salaryId} />
                                        </If>
                                        <Else>
                                            <If condition={salary.is_closed === false}>
                                                <div className="manualSalary__add">
                                                    <button onClick={(e) => {
                                                        e.preventDefault();
                                                        updateIsShown(true)
                                                    }}
                                                        className="manualSalary__add--btn">
                                                        <span className="manualSalary__add--plus"></span>
                                                        Salaris regel toevoegen
                                        </button>
                                                </div>
                                            </If>
                                        </Else>
                                        <div className="subtotal">
                                            <p>Subtotal : <span className="subtotal__amount">{toDutchValue(calculateTotalDaysManual(salary))}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="employee-detail-block__tab no-padding">
                                <h2 className="salaryh2Title">Bruto salaris indicatie maand: {brutoSalaryDate}</h2>
                                <SalaryIndicator scores={calculateTotalDays(salary)} custom={calculateTotalDaysManual(salary)} />
                            </div>
                        </form>

                    </Else>
                </If>

            </Layout>
        </div >
    )
}

const mapStateToProps = state => {
    return ({
        salary: state.salary.salary,
        loading: state.salary.loading
    })
}

export default withRouter(connect(mapStateToProps, { removeSalary, fetchSalary })(SalaryDetail));
