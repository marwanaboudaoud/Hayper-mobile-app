import React,{useState,useEffect} from 'react'
import Layout from '../../components/Layout'
import Btn from '../../components/Btn/index'
import Input from '../../components/Input/index'
import Dropdown from '../../components/Dropdown/index'
import PageHead from '../../components/PageHead/PageHead'
import { updateRole, fetchRole } from '../../actions/rolesActions'
import { connect } from 'react-redux'
import { If, Then, Else } from 'react-if'
import Spinner from '../../components/Spinner';

function FunctiesEdit({ history,updateRole,match:{params:{id}},fetchRole,loading,role, fetching}) {
    const [title, updateTitle] = useState();
    const [code_in_nmbrs, updateNbmrs] = useState();

    const handleSubmit = e => {
        const payload = {
            title,
            code_in_nmbrs,
            id
        }
        updateRole(payload);

        e.preventDefault();
    };

    useEffect(() => {
        fetchRole(id)
    }, [])

    useEffect(() => {
        updateTitle(role.title);
        updateNbmrs(role.code_in_nmbrs)
    },[role])

    return (
        <Layout>
            <PageHead fetching={fetching} title={'Functies edit'} typeOf={'submit'} formId={'functies-form'} btnTitle={'Update'} onClickCancel={() => history.goBack()} />
            <If condition={loading}>
                <Then>
                    <Spinner/>
                </Then>
                <Else>
                    <div className="employee-detail-block__tab">
                        <form id='functies-form' onSubmit={e => handleSubmit(e)} className="row">
                            <div className="col-xs-6">
                                <Input required label={'Titel'} value={title || ''} type={'text'} name={'Titel-input'} onChange={(n,v) => updateTitle(v) } />
                            </div>
                            <div className="col-xs-6">
                                <Input required label={'NMBRS code'} value={code_in_nmbrs || ''} type={'text'} name={'NMBRS code'} onChange={(n,v) => updateNbmrs(v)} />
                            </div>
                        </form>
                    </div>
                </Else>
            </If>
        </Layout>
    )
}
const mapStateToProps = state => ({
    loading: state.role.loading,
    role: state.role.role,
    fetching:state.role.fetching,
})
export default connect(mapStateToProps, {updateRole,fetchRole})(FunctiesEdit)
