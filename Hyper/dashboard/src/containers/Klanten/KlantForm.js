import React,{useState, useEffect} from 'react'
import Layout from '../../components/Layout'
import {connect} from 'react-redux';
import Input from '../../components/Input/index'
import {setPartnerFinished,storePartners,updatePartners,getPartner,resetPartner} from '../../actions/partnerActions';
import { If, Then, Else } from 'react-if';
import Spinner from '../../components/Spinner';
import PageHead from '../../components/PageHead/PageHead';

const KlantForm = ({fetching,setPartnerFinished,resetPartner,partner,loading,history,storePartners,updatePartners,getPartner,update,id}) => {
    const [name , updateCompanyName] = useState('')
    const [street, updateStreet] = useState('');
    const [place, updatePlace] = useState('');
    const [homeNumber , updateHomeNumber] = useState('');
    const [add, updateAdd] = useState('');
    const [postCode, updatePostCode] = useState('');
    const [phone, updatePhone] = useState('');
    const handleSubmit = e => {
        e.preventDefault();
       const payload = {
           name,
           address: street,
           postcode:postCode,
           city: place,
           house_number: `${homeNumber}${add}`,
           phone
       }
       return update ? updatePartners(payload,id) : storePartners(payload)
    };

    useEffect(() => {
        if(update){
            getPartner(id)
        }else {
             setPartnerFinished()
        }
        return () =>  resetPartner();
    },[]);

    useEffect(() => {
        updateCompanyName(partner.name)
        updateStreet(partner.address)
        updatePlace(partner.city)
        updateHomeNumber(partner.house_number)
        updatePhone(partner.phone)
        updatePostCode(partner.postcode)
    },[partner])

    return (
        <>
            <PageHead fetching={fetching} btnTitle={update ? 'Klant wijzigen' : 'Klant toevoegen'} typeOf={'submit'} title={'Klant'} formId={'klant-form'} onClickCancel={() => history.goBack()} />
            <div className="employee-detail-block__tab">
                <If condition={loading}>
                    <Then>
                    <Spinner/>
                    </Then>
                    <Else>
                    <form id='klant-form' onSubmit={e => handleSubmit(e)} className="row">
                        <div className="col-xs-6">
                            <Input required label={'Bedrijfsnaam'} value={name} type={'text'} name={'Bedrijfsnaam-input'} onChange={(name,value) => updateCompanyName(value)} />
                        </div>
                        <div className="col-xs-6">
                            <Input required label={'Straat'} type={'text'} value={street} name={'Straat-input'} onChange={(name,value) => updateStreet(value)} />
                        </div>
                        <div className="col-xs-6">
                            <Input required label={'Plaats'} type={'text'} value={place} name={'Plaats-input'} onChange={(name,value) => updatePlace(value)} />
                        </div>
                        <div className="col-xs-6">
                            <Input required label={'Huisnummer'} type={'text'} value={homeNumber} name={'Huisnummer-input'} onChange={(name,value) => updateHomeNumber(value)}/>
                        </div>
                        {/* <div className="col-xs-3">
                            <Input label={'Toevoeging'} type={'text'} value={add} name={'Toevoeging-input'} onChange={(name,value) => updateAdd(value)} />
                        </div> */}
                        <div className="col-xs-6">
                            <Input label={'Postcode'} type={'text'} value={postCode} name={'Postcode-input'} onChange={(name,value) => updatePostCode(value)} />
                        </div>
                        <div className="col-xs-6">
                            <Input label={'Telefoonnummer'} type={'string'} value={phone} name={'Telefoonnummer-input'} onChange={(name,value) => updatePhone(value)}/>
                        </div>
                    </form>
                    </Else>
                </If>
            </div>
        </>
    )
}

const mapStateToProps = state => ({
    loading:state.partners.loading,
    partner:state.partners.partner,
    fetching:state.partners.fetching
})
export default connect(mapStateToProps, {setPartnerFinished,resetPartner,storePartners,updatePartners,getPartner})(KlantForm)
