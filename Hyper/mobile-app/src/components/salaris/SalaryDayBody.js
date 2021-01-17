import React from 'react'
import styles from './index.module.scss'
import { calculateTotalRows, calculateTotalRowsDifference } from '../../utils/calculate';
import Spinner from '../Spinner'
import { If, Then, Else } from 'react-if';
import { connect } from 'react-redux'
import { fetchMyAvailability } from "../../actions/availabilityAction";


const SalaryDayBody = ({ salary, loading }) => {
    const positiveSalary = salary.salaries.map(salary => ({ ...salary, rows: salary.rows.filter(row => row.price >= 0) }));
    const negativeSalary = salary.salaries.map(salary => ({ ...salary, rows: salary.rows.filter(row => row.price < 0) }));
    return (
        <div style={{ overflowY: 'scroll', paddingBottom: '70px', paddingLeft: '15px', paddingRight: '15px' }}>
            <div>
                <If condition={loading}>
                    <Then>
                        <div className={styles.spinnerContainer}>
                            <Spinner />
                        </div>
                    </Then>
                    <Else>
                        <div className={styles.row}>
                            {positiveSalary.map(salary => salary.rows.map((row, i) => {
                                return (
                                    <div key={i}>
                                        <div className={styles.componentBody}>
                                            <p className={styles.description}>{row.description}</p>
                                            <p className={styles.rowNo}> {row.amount > 0 ? `${row.amount} x €${row.price.toFixed(2)}` : ''}</p>
                                            <p className={styles.rowNo}> €{(row.amount * row.price).toFixed(2)}</p>
                                        </div>
                                        <div>
                                            <p className={styles.underlineDescription} >{row.underline_description} </p>
                                        </div>
                                    </div>
                                )
                            }))
                            }
                            <hr className={styles.underline} />
                            <div className={styles.componentBody}>
                                <p style={{ fontWeight: 'bold', color: '#142407' }}>Opbrengsten {salary.partner}</p>
                                <p style={{ fontWeight: '500', color: '#142407' }}>€ {calculateTotalRows(positiveSalary)}</p>
                            </div>
                        </div>
                        <div className={styles.row}>
                            {negativeSalary.map(salary => salary.rows.map((row, i) => {
                                return (
                                    <div key={i}>
                                        <div className={styles.componentBody}>
                                            <p className={styles.description}>Afvaller (ID: {salary.id})</p>
                                            <p style={{ color: '#EB5757', fontWeight: '500' }}> {row.amount} x €{row.price.toFixed(2)}</p>
                                            <p style={{ color: '#EB5757', fontWeight: '500' }}> €{(row.amount * row.price).toFixed(2)}</p>
                                        </div>
                                        <div>
                                            <p className={styles.underlineDescription}>{row.underline_description} </p>
                                        </div>
                                    </div>
                                )
                            }))
                            }
                            <hr className={styles.underline} />
                            <div className={styles.componentBody}>
                                <p style={{ fontWeight: 'bold', color: '#142407' }}>Correctie</p>
                                <p style={{ color: '#EB5757', fontWeight: '500' }}>€ {calculateTotalRows(negativeSalary)}</p>
                            </div>
                        </div>
                    </Else>
                </If>
                <div className={styles.amount} >
                    <span className={styles.amountText}> Dagtotaal </span>
                    <span className={styles.amountNo}>{loading ? <Spinner width={24} color={'white'} type={'ThreeDots'} /> : `€ ${calculateTotalRowsDifference(positiveSalary, negativeSalary)}`}  </span>
                </div>
            </div>
        </div>
    )
}

const mapStateToProps = state => ({
    date: state.availability.date,
    salaries: state.salaries.salaries,
    loading: state.salaries.loading,
})


export default connect(mapStateToProps, { fetchMyAvailability })(SalaryDayBody)


