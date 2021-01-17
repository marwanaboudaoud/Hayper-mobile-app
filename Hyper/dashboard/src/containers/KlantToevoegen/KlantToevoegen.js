import React from 'react'
import Layout from '../../components/Layout'


import Input from '../../components/Input/index'
import PageHead from '../../components/PageHead/PageHead'


const KlantToevoegen = ({ history }) => {
    return (
        <Layout>
            <PageHead title={'Klant toevoegen'} btnTitle={'Klant toevoegen'} onClickSuccess={(event) => console.log('success ' + event.target.innerText)} onClickCancel={() => history.goBack()} />
            <div className="employee-detail-block__tab">
                <div className="row">
                    <div className="col-xs-6">
                        <Input label={'Bedrijfsnaam'} type={'text'} name={'Bedrijfsnaam-input'} onChange={() => console.log('Bedrijfsnaam-input-test')} />
                    </div>
                    <div className="col-xs-6">
                        <Input label={'Straat'} type={'text'} name={'Straat-input'} onChange={() => console.log('Straat-input-test')} />
                    </div>
                    <div className="col-xs-6">
                        <Input label={'Plaats'} type={'text'} name={'Plaats-input'} onChange={() => console.log('Plaats-input - test')} />
                    </div>
                    <div className="col-xs-3">
                        <Input label={'Huisnummer'} type={'number'} name={'Huisnummer-input'} onChange={() => console.log('huisnummer-input - test')} />
                    </div>
                    <div className="col-xs-3">
                        <Input label={'Toevoeging'} type={'text'} name={'Toevoeging-input'} onChange={() => console.log('Toevoeging-input - test')} />
                    </div>
                    <div className="col-xs-6">
                        <Input label={'Postcode'} type={'text'} name={'Postcode-input'} onChange={() => console.log('Postcode-input - test')} />
                    </div>
                    <div className="col-xs-6">
                        <Input label={'Telefoonnummer'} type={'number'} name={'Telefoonnummer-input'} onChange={() => console.log('Telefoonnummer-input - test')} />
                    </div>
                </div>
            </div>
        </Layout>
    )
}

export default KlantToevoegen
