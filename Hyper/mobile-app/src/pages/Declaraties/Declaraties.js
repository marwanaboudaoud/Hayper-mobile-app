import React, { useState, useEffect } from "react";
import Menu from "../../components/menu/Menu";
import generalStyles from "../general.module.scss";
import styles from "./index.module.scss";
// import Minus from "../../assets/img/icons/minus.svg";
// import Right from "../../assets/img/icons/right.svg";
// import Wrong from "../../assets/img/icons/wrong.svg";
// import Popup from "reactjs-popup";
// import PopupForm from "./PopupForm";
import { If, Then, Else, } from "react-if";
import Spinner from '../../components/Spinner/index'
import SuccessPopup from './successPopup'
import RedX from '../../assets/img/icons/red-x.svg'
import Input from "../../components/Input";
import { uploadDeclaration, resetDeclaration } from "../../actions/declarationsActions";
import { connect } from 'react-redux';

const Declaraties = ({ close, uploadDeclaration, resetDeclaration, loading, finished }) => {
  const [type, updateType] = useState('')
  const [date, updateDate] = useState('')
  const [location, updateLocation] = useState('');
  const [price, updatePrice] = useState('');
  const [vat, updateVat] = useState('');
  const [image, updateImage] = useState('');
  const [error, updatError] = useState(false);


  useEffect(() => {
    resetDeclaration()
  }, [])

  const handleSubmit = e => {
    e.preventDefault();
    if (type === '' || date === '' || location === '' || price === '' || vat === '' || image === '') {
      updatError(true)
      return null;
    }

    const formData = new FormData();
    formData.append('declaration_type', type)
    formData.append('image', image);
    formData.append('date_of_submission', date);
    formData.append('location', location);
    formData.append('amount_exc_vat', price);
    formData.append('vat', vat);
    updatError(false)
    return uploadDeclaration(formData);
  }

  return (
    <div
      className="container"
      style={{
        height: "100vh",
        justifyContent: "unset",
        alignItems: "unset"
      }}
    >
      <div className={generalStyles.header}>
        <Menu />
        <h4 className={generalStyles.headerTitle}>Declaratie indienen</h4>
      </div>

      <div style={{ marginTop: "10px", overflowY: "scroll" }}>
        {/* <div className={styles.row}>
            <div className={styles.componentsHeader}>
              <p className={styles.id}>Reiskosten</p>
              <p>30-06-2019</p>
            </div>
            <hr className={styles.underline} />
            <div style={{ display: "flex" }}>
              <img className={styles.stateImg} src={Minus} alt="" />
              <div className={styles.componentBody}>
                <p>In behandeling</p>
                <p> € 50,00</p>
              </div>
            </div>
          </div> */}
        {/* <div className={styles.row}>
            <div className={styles.componentsHeader}>
              <p className={styles.id}>Reiskosten</p>
              <p>03-04-2019</p>
            </div>
            <hr className={styles.underline} />
            <div style={{ display: "flex" }}>
              <img className={styles.stateImg} src={Right} alt="" />
              <div className={styles.componentBody}>
                <p> Goedgekeurd</p>
                <p> € 50,00</p>
              </div>
            </div>
          </div> */}
        {/* <div className={styles.row}>
            <div className={styles.componentsHeader}>
              <p className={styles.id}>Reiskosten</p>
              <p>30-06-2019</p>
            </div>
            <hr className={styles.underline} />
            <div style={{ display: "flex" }}>
              <img className={styles.stateImg} src={Wrong} alt="" />
              <div className={styles.componentBody}>
                <p>Afgekeurd</p>
                <p> € 50,00</p>
              </div>
            </div>
          </div> */}
        {/* <div className={styles.row}>
            <div className={styles.componentsHeader}>
              <p className={styles.id}>Reiskosten</p>
              <p>30-06-2019</p>
            </div>
            <hr className={styles.underline} />
            <div style={{ display: "flex" }}>
              <img className={styles.stateImg} src={Right} alt="" />
              <div className={styles.componentBody}>
                <p>Goedgekeurd</p>
                <p> € 50,00</p>
              </div>
            </div>
          </div> */}
        <div className={styles.row}>
          {/* <div className={styles.componentsHeader}>
              <p className={styles.id}>Reiskosten</p>
              <p>30-06-2019</p>
            </div>
            <hr className={styles.underline} />
            <div style={{ display: "flex" }}>
              <img className={styles.stateImg} src={Minus} alt="" />
              <div className={styles.componentBody}>
                <p>In behandeling</p>
                <p> € 50,00</p>
              </div>
            </div> */}
          <div className={styles.modal}>


            <If condition={error}>
              <Then>
                <div className={styles.errorMessageContainer}>
                  <img style={{ width: '7%' }} src={RedX} alt="" />
                  <span className={styles.errorMessage}>Vul alle velden in.</span>
                </div>
              </Then>
            </If>
            <If condition={!loading}>
              <Then>
                <If condition={finished}>
                  <Then>
                    <SuccessPopup />
                  </Then>
                  <Else>
                    <form onSubmit={e => handleSubmit(e)} className={styles.content}>
                      <div className={styles.selectContainers}>
                        <label className={styles.label}>Kostensoort *</label>
                        <select onChange={e => updateType(e.target.value)} style={{ backgroundColor: 'white' }} className={styles.popupSelect}>
                          <option value="">- Selecteer kostensoort -</option>
                          <option value="Tanken">Tanken</option>
                          <option value="Eten">Eten</option>
                          <option value="Parkeren ">Parkeren</option>
                          <option value="Reiskosten">Reiskosten</option>
                          <option value="Overig">Overig</option>
                        </select>
                      </div>
                      <div className={styles.selectContainers}>
                        <label className={styles.label}> Datum *  </label>
                        <input style={{ backgroundColor: 'white' }} className={styles.popupSelect} onChange={e => updateDate(e.target.value)} type="date" name="datum" value={date} />
                      </div>
                      <div className={styles.selectContainers}>
                        <label className={styles.label}>Plaats/Vestiging * </label>
                        <select onChange={e => updateLocation(e.target.value)} style={{ backgroundColor: 'white' }} className={styles.popupSelect}>
                          <option value="">- Selecteer plaats/vestiging -</option>
                          <option value="Rotterdam">Rotterdam</option>
                          <option value="Amsterdam">Amsterdam</option>
                        </select>
                      </div>
                      <div style={{ display: "flex", justifyContent: "space-between" }}>
                        <div className={styles.smallInputContainer}>
                          <label className={styles.label}> Bedrag (excl.) * </label>
                          <input
                            className={styles.smallInput}
                            value={price}
                            type="number"
                            label="$ *"
                            name="price"
                            step={'0.01'}
                            onChange={e => updatePrice(`${e.target.value}`)}
                          />
                        </div>
                        <div className={styles.smallSelectContainers}>
                          <label className={styles.label}>Btw % * </label>
                          <select onChange={e => updateVat(e.target.value)} style={{ backgroundColor: 'white' }} className={styles.popupSelect} >
                            <option value=""></option>
                            <option value="9">9</option>
                            <option value="12">12</option>
                            <option value="21">21</option>
                          </select>
                        </div>
                      </div>
                      <div className={styles.flexContainer}>
                        {/* <label className={styles.selecteerBtn} for="upload" >Selecteer</label> */}
                        {/* <label for="upload" className={styles.labelCustom} > Afbeelding *</label> */}
                        <Input id="upload" style={{ padding: '0px' }} label="Bestand *" name="upload" onChange={e => updateImage(e.target.files[0])} type="file" />
                      </div>
                      <hr className={styles.underline} />
                      <div style={{ display: "flex", justifyContent: "space-between" }}>
                        {/* <button className={styles.cancelBtn} type="button" onClick={close} >
                          <span className={styles.cancelBtnText}> Annuleren </span>
                        </button> */}
                        <button className={styles.confirmBtn} type="submit">
                          <span className={styles.confirmBtnText}>Indienen </span>
                        </button>
                      </div>
                    </form>

                  </Else>
                </If>
              </Then>
              <Else>
                <div className={styles.spinnerContainer}>
                  <Spinner />
                </div>
              </Else>
            </If>
          </div>
        </div>
      </div>
    </div>
  );
}


const mapStateToProps = state => ({
  loading: state.declaration.loading,
  finished: state.declaration.finished
})


export default connect(mapStateToProps, { uploadDeclaration, resetDeclaration })(Declaraties);
