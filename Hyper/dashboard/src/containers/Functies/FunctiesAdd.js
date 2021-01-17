import React,{useState} from 'react'
import Layout from '../../components/Layout'
import Btn from '../../components/Btn/index'
import Input from '../../components/Input/index'
import Dropdown from '../../components/Dropdown/index'
import PageHead from '../../components/PageHead/PageHead'
import { createRole } from '../../actions/rolesActions'
import { connect } from 'react-redux'

function FunctiesToevoegen({ history,createRole,fetching }) {
    const [title, updateTitle] = useState();
    const [code_in_nmbrs, updateNbmrs] = useState();

    const handleSubmit = e => {
        const payload = {
            title,
            code_in_nmbrs
        }
        createRole(payload);

        e.preventDefault();
    };

    return (
        <Layout>
            <PageHead title={'Functies toevoegen'} fetching={fetching} typeOf={'submit'} formId={'functies-form'} btnTitle={'Functies toevoegen'} onClickCancel={() => history.goBack()} />
            <div className="employee-detail-block__tab">
                <form id='functies-form' onSubmit={e => handleSubmit(e)} className="row">
                    <div className="col-xs-6">
                        <Input required label={'Titel'} value={title} type={'text'} name={'Titel-input'} onChange={(n,v) => updateTitle(v) } />
                    </div>
                    <div className="col-xs-6">
                        <Input required label={'NMBRS code'} value={code_in_nmbrs} type={'number'} name={'NMBRS code'} onChange={(n,v) => updateNbmrs(v)} />
                    </div>
                </form>
            </div>
        </Layout>
    )
}
const mapStateToProps = state => ({
    fetching: state.roles.fetching,
})

export default connect(mapStateToProps, {createRole})(FunctiesToevoegen)
