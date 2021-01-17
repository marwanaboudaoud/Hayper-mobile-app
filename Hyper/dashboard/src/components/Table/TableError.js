import React from 'react'
import Failed from '../../assets/img/icons/failed.svg'

const TableError = ({message}) => {
    return (
        <div className="table__error">
             <img className={'table__error'} src={Failed} alt='Failed' />
             <p className={'table__error-message'} >{message ? message : 'Er is iets fout gegaan. Probeer opnieuw later!'}</p>

        </div>
    )
}

export default TableError
