// import React, { useState, useEffect } from "react";
// import styles from "./index.module.scss";
// import Input from "../../components/Input";
// import { connect } from 'react-redux';
// import { uploadDeclaration, resetDeclaration } from "../../actions/declarationsActions";
// import { If, Then, Else, } from "react-if";
// import Spinner from '../../components/Spinner/index'
// import SuccessPopup from './successPopup'
// import RedX from '../../assets/img/icons/red-x.svg'


// const PopupForm = ({ close, uploadDeclaration, resetDeclaration, loading, finished }) => {
//   const [type, updateType] = useState('')
//   const [date, updateDate] = useState('')
//   const [location, updateLocation] = useState('');
//   const [price, updatePrice] = useState('');
//   const [vat, updateVat] = useState('');
//   const [image, updateImage] = useState('');
//   const [error, updatError] = useState(false)

//   useEffect(() => {
//     resetDeclaration()
//   }, [])

//   const handleSubmit = e => {
//     e.preventDefault();
//     if (type === '' || date === '' || location === '' || price === '' || vat === '' || image === '') {
//       updatError(true)
//       return null;
//     }

//     const formData = new FormData();
//     formData.append('declaration_type', type)
//     formData.append('image', image);
//     formData.append('date_of_submission', date);
//     formData.append('location', location);
//     formData.append('amount_exc_vat', price);
//     formData.append('vat', vat);
//     updatError(false)
//     return uploadDeclaration(formData);
//   }

//   return (
//     <div className={styles.modal}>
//       <button
//         style={{ color: "#EB5757" }}
//         className={styles.close}
//         onClick={close}
//       >
//         &times;
//        </button>
//       <div className={styles.popupHeader}> Declaratie indienen </div>
//       <If condition={error}>
//         <Then>
//           <div className={styles.errorMessageContainer}>
//             <img style={{ width: '7%' }} src={RedX} alt="" />
//             <span className={styles.errorMessage}>Vul alle velden in.</span>
//           </div>
//         </Then>
//       </If>
//       <If condition={!loading}>
//         <Then>
//           <If condition={finished}>
//             <Then>
//               <SuccessPopup />
//             </Then>
//             <Else>
//               <form onSubmit={e => handleSubmit(e)} className={styles.content}>
//                 <div className={styles.selectContainers}>
//                   <label className={styles.label}>Kostensoort *</label>
//                   <select onChange={e => updateType(e.target.value)} style={{ backgroundColor: 'white' }} className={styles.popupSelect}>
//                     <option value="">- Selecteer kostensoort -</option>
//                     <option value="Contract">Contract</option>
//                     <option value="CV">CV</option>
//                     <option value="Diploma">Diploma</option>
//                     <option value="Foto">Foto</option>
//                     <option value="Foto medewerker">Foto medewerker</option>
//                     <option value="Identiteitskaart">Identiteitskaart</option>
//                     <option value="Loonbelastingverklaring">Loonbelastingverklaring</option>
//                     <option value="Medewerker-login-docment">Medewerker-login-docment</option>
//                     <option value="Motivational letter">Motivational Letter</option>
//                     <option value="Overig">Overig</option>
//                     <option value="Planning">Planning</option>
//                   </select>
//                 </div>
//                 <div className={styles.selectContainers}>
//                   <label className={styles.label}> Datum *  </label>
//                   <input style={{ backgroundColor: 'white' }} className={styles.popupSelect} onChange={e => updateDate(e.target.value)} type="date" name="datum" value={date} />
//                 </div>
//                 <div className={styles.selectContainers}>
//                   <label className={styles.label}>Plaats/Vestiging * </label>
//                   <select onChange={e => updateLocation(e.target.value)} style={{ backgroundColor: 'white' }} className={styles.popupSelect}>
//                     <option value="">- Selecteer plaats/vestiging -</option>
//                     <option value="Rotterdam">Rotterdam</option>
//                     <option value="Amsterdam">Amsterdam</option>
//                   </select>
//                 </div>
//                 <div style={{ display: "flex", justifyContent: "space-between" }}>
//                   <div className={styles.smallInputContainer}>
//                     <label className={styles.label}> Bedrag (excl.) * </label>
//                     <input
//                       className={styles.smallInput}
//                       value={price}
//                       type="number"
//                       label="$ *"
//                       name="price"
//                       step={'0.01'}
//                       onChange={e => updatePrice(`${e.target.value}`)}
//                     />
//                   </div>
//                   <div className={styles.smallSelectContainers}>
//                     <label className={styles.label}>Btw % * </label>
//                     <select onChange={e => updateVat(e.target.value)} style={{ backgroundColor: 'white' }} className={styles.popupSelect} >
//                       <option value=""></option>
//                       <option value="9">9</option>
//                       <option value="12">12</option>
//                       <option value="21">21</option>
//                     </select>
//                   </div>
//                 </div>
//                 <div className={styles.flexContainer}>
//                   {/* <label className={styles.selecteerBtn} for="upload" >Selecteer</label> */}
//                   {/* <label for="upload" className={styles.labelCustom} > Afbeelding *</label> */}
//                   <Input id="upload" style={{ padding: '0px' }} label="Afbeelding *" name="upload" onChange={e => updateImage(e.target.files[0])} type="file" />
//                 </div>
//                 <hr className={styles.underline} />
//                 <div style={{ display: "flex", justifyContent: "space-between" }}>
//                   <button className={styles.cancelBtn} type="button" onClick={close} >
//                     <span className={styles.cancelBtnText}> Annuleren </span>
//                   </button>
//                   <button className={styles.confirmBtn} type="submit">
//                     <span className={styles.confirmBtnText}>Indienen </span>
//                   </button>
//                 </div>
//               </form>
//             </Else>
//           </If>
//         </Then>
//         <Else>
//           <div className={styles.spinnerContainer}>
//             <Spinner />
//           </div>
//         </Else>
//       </If>
//     </div>
//   )
// };

// const mapStateToProps = state => ({
//   loading: state.declaration.loading,
//   finished: state.declaration.finished
// })

// export default connect(mapStateToProps, { uploadDeclaration, resetDeclaration })(PopupForm);