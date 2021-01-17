import React from 'react'
import Btn from '../Btn/index'

import './PageHead.styles.scss'

const PageHead = ({fetching, typeOf, formId, title, onClickSuccess, onClickCancel, btnTitle, hideSuccesButton }) => {
    return (
        <div className="page-top">
            <h1 className="page-top__header">{title}</h1>
            <div className="page-top__buttons">
                {hideSuccesButton !== true ?<Btn size={15} loading={fetching} onClick={onClickSuccess} typeOf={typeOf}  form={formId} type="primary small">{btnTitle}</Btn> : null}
                <Btn  onClick={onClickCancel} type="secondary small">Annuleren</Btn>
            </div>
        </div>
    )
}

export default PageHead
