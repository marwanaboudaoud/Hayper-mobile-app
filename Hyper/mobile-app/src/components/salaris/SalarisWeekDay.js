import React, { useState } from 'react';
import styles from './index.module.scss';
import { Card, Accordion } from 'react-bootstrap';
import { formatDayToNaLSalaris } from '../../utils/Date';
import ArrowDown from '../../assets/img/icons/collaps-arrow-down.svg';
import { calculateTotalRowsDifference } from '../../utils/calculate';


const SalarisWeekDay = ({ salary }) => {
    const isEmpty = salary.salaries.length === 0 ? true : false
    // const sortedSalary = salary.salaries.map(salary => ({ ...salary, rows: salary.rows.sort((a, b) => a.price - b.price) }));
    const positiveSalary = salary.salaries.map(salary => ({ ...salary, rows: salary.rows.filter(row => row.price >= 0) }));
    const negativeSalary = salary.salaries.map(salary => ({ ...salary, rows: salary.rows.filter(row => row.price < 0) }));
    const [selected, setSelected] = useState(true);
    return (
        <div style={{ marginTop: '10px', paddingLeft: '15px', paddingRight: '15px' }} >
            <Accordion defaultActiveKey="0">
                <Card className={styles.card}>
                    <Card.Header style={{ backgroundColor: 'white', border: 'none' }}>
                        <Accordion.Toggle eventKey={isEmpty ? [] : '1'} className={styles.toggle} onClick={() => setSelected(!selected)}  >
                            <div style={{
                                display: 'flex',
                                justifyContent: 'space-between'
                            }}>
                                <span className={styles.date}>{formatDayToNaLSalaris(salary.date)}</span>
                                <div>
                                    <span> € {calculateTotalRowsDifference(positiveSalary, negativeSalary)}</span>
                                    <img className={styles.rotateArrow + (isEmpty ? ` ${styles.rotateArrowHide} ` : !selected ? ` ${styles.rotateArrowUp} ` : ' ')} src={ArrowDown} alt="" />
                                </div>
                            </div>
                        </Accordion.Toggle>
                    </Card.Header>
                    <Accordion.Collapse eventKey="1">
                        <Card.Body>
                            <hr className={styles.weekCollapsUnderline} />
                            {positiveSalary.map(salary => salary.rows.map(row => (
                                <>
                                    <div className={styles.componentBody}>
                                        <p className={styles.description}>{row.description}</p>
                                        <p className={styles.rowNo}> {row.amount}x € {row.price.toFixed(2)}</p>
                                        <p className={styles.rowNo}> €{(row.amount * row.price).toFixed(2)}</p>
                                    </div>
                                    <div>
                                        <p className={styles.underlineDescription}>{row.underline_description}</p>
                                    </div>
                                </>
                            )))}
                            {negativeSalary.map(salary => salary.rows.map(row => (
                                <>
                                    <div className={styles.componentBody}>
                                        <p className={styles.description}>{row.description}</p>
                                        <p style={{ color: '#EB5757', fontWeight: '500' }}> {row.amount}x € {row.price.toFixed(2)}</p>
                                        <p style={{ color: '#EB5757', fontWeight: '500' }}> €{(row.amount * row.price).toFixed(2)}</p>
                                    </div>
                                    <div>
                                        <p className={styles.underlineDescription}>{row.underline_description}</p>
                                    </div>
                                </>
                            )))}
                        </Card.Body>
                    </Accordion.Collapse>
                </Card>
            </Accordion>
        </div>
    )
}

export default SalarisWeekDay
