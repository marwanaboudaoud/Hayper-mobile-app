import React from 'react'
import Loader from 'react-loader-spinner'

const Spinner = ({width}) => (
    <div className='spinner'>
        <Loader
            type="TailSpin"
            color="#F58422"
            height={100}
            width={width
            ? width
            : 100}/>

    </div>
)

export default Spinner;
