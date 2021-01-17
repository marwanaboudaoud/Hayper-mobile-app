import React, {useState} from 'react'

const ProjectButton = ({updateToggle}) => {
    const [active,
        setActive] = useState(false);
    return <button
                onClick={() => {
                    setActive(!active)
                    updateToggle()
                }}
                className={"project__button " 
                + (active ? " project__button-active" : '')}>
            </button>
}

export default ProjectButton
