import React from 'react'
import './Blocktab.styles.scss'

const Blocktab = (props, noPadding) => {
    return (
        <div className={noPadding ? "employee-detail-block__tab" : "employee-detail-block__tab no-padding"}>
            <h2>{props.title}</h2>
            <div className="row">
                {props.children}
            </div>
        </div>
    )
}

export default Blocktab
