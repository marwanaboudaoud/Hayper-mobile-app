import React, { useEffect } from 'react'
import styles from './index.module.scss'
import { connect } from 'react-redux';
import { fetchMySalaris } from '../../actions/salarisAction';
import { totalDaysWorked, totalDescriptions, calculateTotalMonth } from '../../utils/calculate';
import Spinner from '../Spinner';
import { If, Then, Else } from 'react-if';


const SalarisMonth = ({ date, salaries, loading, fetchMySalaris }) => {
    useEffect(() => {
        fetchMySalaris({
            "start_date": date.startOfMonth,
            "end_date": date.endOfMonth
        })
    }, [date])

    return (
        <div style={{ overflowY: 'scroll', paddingBottom: '75px', paddingLeft: '15px', paddingRight: '15px' }}>
            <If condition={loading}>
                <Then>
                    <div className={styles.spinnerContainer}>
                        <Spinner />
                    </div>
                </Then>
                <Else>
                    <div className={styles.row}>
                        <div className={styles.componentsHeader}>
                            <p className={styles.monthDescription}>Aantal dagen gewerkt</p>
                            <p style={{ marginBottom: '0px', color: '#142407', fontWeight: '500' }}>{totalDaysWorked(salaries)}</p>
                        </div>
                    </div>
                    {totalDescriptions(salaries).map(({ name, total }) => (
                        <>
                            <div className={styles.row}>
                                <div className={styles.componentsHeader}>
                                    <p className={styles.monthDescription}>{name}</p>
                                    <p style={{ marginBottom: '0px', fontWeight: '500', color: `${total < 0 ? 'red' : ''}` }}>€ {total}</p>
                                </div>
                            </div>
                        </>
                    ))}
                    <button className={styles.pdfBtn} type="button">
                        <span className={styles.pdfBtnText}> Loonstrook (PDF) Openen </span>
                    </button>
                </Else>
            </If>
            <div className={styles.amount} >
                <span className={styles.amountText}> Bruto salaris</span>
                <span className={styles.amountNo}> {loading ? <Spinner width={24} color={'white'} type={'ThreeDots'} /> : `€ ${calculateTotalMonth(salaries)}`}</span>
            </div>
        </div>
    )
}

const mapStateToProps = state => ({
    date: state.salaries.monthDate,
    salaries: state.salaries.salaries,
    loading: state.salaries.monthLoading
})

export default connect(mapStateToProps, { fetchMySalaris })(SalarisMonth);