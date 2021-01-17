import React from 'react'

const TableBoolean = ({boolean}) => <span className={`table__${boolean}`}>{`${boolean ? 'Ja' : 'Nee'}`}</span>

export default TableBoolean
