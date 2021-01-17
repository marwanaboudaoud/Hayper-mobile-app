import React from 'react';
import SalaryExpandedRow from '../../components/SalaryExpandedRow/SalaryExpandedRow'

function SalaryExpandDetails({ expandedDetails }) {
    const detailRows = expandedDetails.map((detail, index) => (
        <SalaryExpandedRow key={index} expandedDetails={detail} />
    ));
    return (
        <div className="salary__details">
            <div className="salary__details--top">
                <h3>Omschrijving</h3>
                <h3>Product</h3>
                <h3>Aantal</h3>
                <h3>Aantal bedrag</h3>
                <h3>Totaal bedrag</h3>
            </div>
            <div className="salary__details--bottom">
                {detailRows}
            </div>
        </div>
    )
}

export default SalaryExpandDetails
