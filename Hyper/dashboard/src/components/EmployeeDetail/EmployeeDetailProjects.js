import React,{useEffect,useState} from 'react'
import Input from '../Input';
import Btn from "../Btn";
import Icon from "../Icon";
import crossIcon from '../../assets/img/icons/green-cross.svg';
import Dropdown from "../Dropdown/special";
import {connect} from 'react-redux';
import { addToForm,addTag,removeTag } from '../../actions/employeeActions';
import {fetchAllProjects} from '../../actions/projectAction';
import { If, Then, Else } from 'react-if';
import Spinner from '../Spinner';

const EmployeeDetailProjects = ({loading,fetchAllProjects,projects,addToForm,tags,removeTag,addTag}) => {
    const [chosenProject, updateChosenProject] = useState(false);
    const chosenTags = tags.map((project, index) => (
        <div key={index} className='projectTag' onClick={() => removeTag(project.id)}>
            <Icon icon={crossIcon} /><span>{project.name}</span>
        </div>
    ));

    const newProject =  () => projects.filter(el => el.hidden !== true);

    const nextProject = () => {
        return newProject()[0].id;
    };

    const isProjectEmpty = () => newProject().length !== 0 ? true : false;
    const handleTag = () => isProjectEmpty() ? addTag(chosenProject): null;
        

    useEffect(() =>{
        if(projects.length > 0 && isProjectEmpty()){
            updateChosenProject(nextProject(projects))
        }
    },[projects]);

    useEffect(() => {
        if(loading){
            fetchAllProjects()
        }
    },[]);

    return (
        <div className="employee-detail-block__tab">
            <h2>Projecten</h2>
            <If condition={loading}>
                <Then>
                    <Spinner/>
                </Then>
                <Else>
                <div className="row">
                    {/* <div className="col-xs-4">
                        <Dropdown  name={'vestiging'} label={'Vestiging'} onChange={() => console.log('test')}  options={[{value: 0, name: 'Hyper Amsterdam'}]} />
                    </div> */}
                    <div className="col-xs-4">
                        <Dropdown name={'project'} label={'Project'} onChange={(e,v) => updateChosenProject(v) } options={isProjectEmpty() ? projects : [{
                            disabled:true, 
                            name: 'Geen Projecten',
                            isDefault: true,
                            }]} />
                    </div>
                    <div className="col-xs-4">
                        <Btn type={'primary small'} 
                        typeOf={'button'}
                        disabled={false}
                         onClick={()=> handleTag()}>Toevoegen</Btn>
                    </div>
                    </div>
                <div className="row">
                    <div className="col-xs-12">
                        {chosenTags}
                    </div>
                </div>
                </Else>
            </If>
        </div>
    )
};
function mapStateToProps(state) {
    return {
        loading: state.projects.loading,
        projects: state.projects.projects,
        tags: state.employees.tags,
    };
}
export default connect(mapStateToProps,{addToForm,addTag,removeTag,fetchAllProjects})(EmployeeDetailProjects);

