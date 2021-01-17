import React from 'react'
import './ManualSalaryRow.styles.scss'
import RedCross from '../../assets/img/icons/red-cross.svg'
import { removeSalary } from '../../actions/salaryAction'
import { connect } from 'react-redux';
import { If, Then, Else } from 'react-if';
import { Ring } from 'react-spinners-css';

function ManualSalaryRow({ isClosed, date, omschrijving, bedrag, removeSalary, id, loading }) {
    return (
        <div className="manualSalaryRow">
            <p>{date}</p>
            <p>{omschrijving}</p>

            <p>{bedrag}</p>
            <If condition={isClosed === false}>
                <Then>
                    <If condition={!id}>
                        <Then>
                            <div className='manualSalaryRow__loader'>
                                <Ring size={20} color={'#F7972E'} />
                            </div>
                        </Then>
                        <Else>
                            <button onClick={() => removeSalary(id)} className="manualSalaryRow__removeBtn"><img src={RedCross}></img></button>
                        </Else>
                    </If>
                </Then>
            </If>
        </div>

    )
}
const mapStateToProps = state => ({
    loading: state.salary.salary_manual_loading,
    isClosed: state.salary.salary.is_closed
})


export default connect(mapStateToProps, { removeSalary })(ManualSalaryRow)
