import React,{useState} from 'react'
import { connect } from 'react-redux'
import CheckIcon from '../../assets/img/icons/check.svg'
import CrossIcon from '../../assets/img/icons/red-cross.svg'
import { Ring } from 'react-spinners-css';
import { updateExpiredContracts, deleteTableRowNoReq } from '../../actions/tableActions'

const TableProlong = ({data,updateExpiredContracts,deleteTableRowNoReq}) => {
    const [submited, updateSubmited] = useState(false);
    const [loading, updateLoading] = useState(false);

    const handleProlong = (b,id) => {
        updateLoading(true);
        const payload = {
            is_extended: b,
            contract_id: id,
        };

        updateExpiredContracts(payload,(boolean => {
            if(boolean === true){
                if(b === false) {
                    deleteTableRowNoReq(id)
                }

                updateSubmited(true)
            } else {
                updateLoading(false)
            }
        }))
    };
    if(!loading && !submited) {
        return (
            <div className="table__prolong">
                <div onClick={() => handleProlong(true,data.id) } className="table__prolong-button table__prolong-accept">
                    <img src={CheckIcon} />
                </div>
                <div onClick={() => handleProlong(false,data.id)} className='table__prolong-button table__prolong-cancel'>
                    <img src={CrossIcon} />
                </div>
            </div>
        )
    } else if (loading && !submited){
        return <Ring color={'#F58422'} size={30}/>
    } else {
        return <span>Verzonden</span>
    }
}

export default connect(null,{updateExpiredContracts,deleteTableRowNoReq})(TableProlong)
