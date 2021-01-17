import React, { useState,useEffect } from 'react'
import Layout from '../../components/Layout'
import Input from '../../components/Input/index'
import Dropdown from '../../components/Dropdown/index'
import Checkbox from '../../components/Checkbox'
import PageHead from '../../components/PageHead/PageHead'
import {connect} from 'react-redux';
import {fetchAllPartners} from '../../actions/partnerActions';
import {storeProject,getProject,setProjectFinished,resetProject,updateProject} from '../../actions/projectAction';
import { If, Else, Then } from 'react-if'
import {withRouter} from 'react-router-dom';
import Spinner from '../../components/Spinner'
import ProjectRates from './ProjectRates'
import {CAPTAIN, PROMOTER} from "../../utils/roleConsts";
function ProjectForm({updateProject,getProject,resetProject,formLoad,setProjectFinished,project,id,update,history,klanten,fetchAllPartners,loading,storeProject}) {
    const [active, toggleActive] = useState(false);
    const [currentKlanten, updateKlanten] = useState(klanten)
    const [partner , updatePartner] = useState('');
    const [name, updateName] = useState('');
    const [commission_rates, updateRates] = useState([])
    useEffect(() => {
        fetchAllPartners()
    }, [])

    useEffect(() => {
       klanten.length > 0 ? updatePartner(klanten[0].value) : updatePartner(0)
       updateKlanten(klanten)
    },[klanten])


    const handleSubmit = e => {
        e.preventDefault();

        const payload = mapPayload();

        update ? updateProject(payload,id)  : storeProject(payload)
    };

    const mapPayload = () => {
        const payload = {
            name,
            is_active: !active ? false : active,
            partner_id:partner,
            commission_rates
        };

        return payload;
    };

    useEffect(() => {
        if(update){
            getProject(id)
        }
        else {
             setProjectFinished()
        }
         return () =>  resetProject();
    },[]);

    useEffect(() => {
     if(update){
        toggleActive(project.is_active);
        updateName(project.name);
        updatePartner(project.partner_id)
        updateRates(project.commission_rates || []);
        updateKlanten(currentKlanten.map(el =>({
            ...el,
            isDefault: el.value === project.partner_id ? true :false
        })));
     }
    },[project])

    return (
        <>
            <PageHead btnTitle={update ? 'Project Wijzigen' : 'Project Toevoegen'} title={'Project'} typeOf={'submit'} formId={'project-form'} onClickCancel={() => history.push('/beheren/projecten')} />
            <div className="employee-detail-block__tab">
                <form id={'project-form'} onSubmit={e => handleSubmit(e) } className="row">
                    <If condition={loading || formLoad}>
                        <Then>
                            <Spinner/>
                        </Then>
                        <Else>
                            <div className="col-xs-6">
                                <Input required value={name || ''}  label={'Titel'} type={'text'} name={'Titel-input'} onChange={(name,value) => updateName(value)} />
                            </div>
                            <div className="col-xs-6">
                                <Dropdown name={'Project-klant'} label={'Klant'} onChange={(name,value) => updatePartner(value)} options={currentKlanten} />
                            </div>
                          
                            <ProjectRates data={commission_rates} updateData={updateRates}/>
                            <div className="col-xs-12">
                                <div className="manualSalary__add">
                                    <button type={'button'} onClick={(e) => updateRates([...commission_rates,{rate:(commission_rates.length + 1),role_id:null}])} className="manualSalary__add--btn">
                                        <span className="manualSalary__add--plus"></span>
                                                Bonus regel toevoegen
                                    </button>
                                </div>
                            </div>
                        </Else>
                    </If>

                </form>
            </div>
        </>
    )
}

const mapStateToProps = state => ({
    project: state.projects.project,
    klanten: state.partners.partners,
    loading: state.partners.loading,
    formLoad: state.projects.loading,
})

export default withRouter(connect(mapStateToProps,{updateProject,getProject,resetProject,setProjectFinished,fetchAllPartners,storeProject})(ProjectForm))
