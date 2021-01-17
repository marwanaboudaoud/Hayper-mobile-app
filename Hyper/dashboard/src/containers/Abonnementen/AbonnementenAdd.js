import React,{useState,useEffect} from 'react'
import Layout from '../../components/Layout'
import Dropdown from '../../components/Dropdown/index'
import Input from '../../components/Input/index'
import Checkbox from '../../components/Checkbox'
import {connect} from 'react-redux';
import {fetchAllProjects} from '../../actions/projectAction';
import { If,Then,Else } from 'react-if'
import Spinner from '../../components/Spinner';
import {updateSubscription, storeSubscription,fetchSubscription,setSubscriptionFinished,resetSubscription } from '../../actions/subscriptionActions'
import PageHead from '../../components/PageHead/PageHead'

const AbonnementenAdd = ({history,fetching,projects,fetchAllProjects,loading,storeSubscription}) => {
    const [title , updateTitle] = useState('');
    const [project , updateProject] = useState('');
    const [months ,updateMonths] = useState('')
    const [reward ,updateReward] = useState('')
    const [gross_amount ,updateGross] = useState('')
    const [is_bonus_calc, updateBonus] = useState(false)
    const [starting_date, updateDate] = useState("")
    const [currentProjects, updateProjects] = useState([])

    useEffect(() => {
        fetchAllProjects()
    }, [])

    useEffect(() => {
       updateProjects(projects)
    },[projects])


    const handleSubmit = e => {
        e.preventDefault();
        const project_id = projects[0].id
        const payload = {
            gross_amount,
            title,
            project_id,
            duration_in_months: months,
            reward,
            bw_code: 'ABC',
            is_bonus_calc,
            starting_date,
        }
        storeSubscription(payload)
    };

    return (
        <Layout>
            <PageHead fetching={fetching} btnTitle={'Abbonement toevoegen'} typeOf={'submit'} formId={'abbonnement-form'} title={'Abonnementen toevoegen'} onClickCancel={(event) => history.push('/beheren/abonnementen')} />
            <div className={"employee-detail-block__tab "}>
                <If condition={loading || currentProjects.length === 0}>
                    <Then>
                        <Spinner/>
                    </Then>
                    <Else>
                        <form onSubmit={(event) => handleSubmit(event)} id='abbonnement-form' className="row">
                            <div className="col-xs-12">
                                <Input required type="numbers" value={title} label={'Titel'} name={'title'} onChange={(name,value) => updateTitle(value)} />
                            </div>
                            <div className="col-xs-6">
                                <Dropdown required={true} name={'abonnementen-project'} label={'Project'} onChange={(name,value) => updateProject(value)} options={currentProjects} />
                            </div>
                            <div className="col-xs-6">
                                <Input required type="numbers" value={months} label={'Abonnementsduur in maanden'} type={'number'} name={'abonnementen-in-months'} onChange={(name,value) => updateMonths(value)} />
                            </div>
                            <div className="col-xs-6">
                                <Input required value={starting_date} label={'Datum ingang nieuwe beloning *'} type={'date'} name={'abonnementen-date-input'} onChange={(name,value) => updateDate(value)} />
                            </div>
                            <div className="col-xs-3">
                                <Input required value={reward} className="yes" label={'Beloning *'} type={'number'} name={'abonnementen-beloning'} onChange={(name,value) => updateReward(value)}/>
                            </div>
                            <div className="col-xs-3">
                                <Input required value={gross_amount} className="yes" label={'Bruto beloning *'} type={'number'} name={'gross_amount'} onChange={(name,value) => updateGross(value)}/>
                            </div>
                            <div className="col-xs-6">
                                <Checkbox required checked={is_bonus_calc} onChange={() => updateBonus(!is_bonus_calc)} name={'my-check'} label={'Telt mee in de bonus berekening'} />
                            </div>
                        </form>
                    </Else>
                </If>
            </div>
        </Layout>
    )
}
const mapStateToProps = state => ({
    projects:state.projects.projects,
    loading:state.projects.loading,
    fetching:state.subscriptions.fetching,
});
export default connect(mapStateToProps,{setSubscriptionFinished,resetSubscription,fetchSubscription,fetchAllProjects,storeSubscription,updateSubscription})(AbonnementenAdd)
