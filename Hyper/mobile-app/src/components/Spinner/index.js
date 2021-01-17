import React from 'react'
import Loader from 'react-loader-spinner'

const Spinner = ({ width, height, color, type }) => (
    <div className='spinner'>
        <Loader
            type={type ? type : "TailSpin"}
            color={color ? color : "#F58422"}
            height={height ? height : '100%'}
            width={width
                ? width
                : 100} />

    </div>
)

export default Spinner;
