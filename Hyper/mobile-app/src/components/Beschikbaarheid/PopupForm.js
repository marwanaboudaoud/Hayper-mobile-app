import React, { useEffect, useState } from 'react'
import styles from './index.module.scss'
import { formatToLetters } from '../../utils/Date';
import { If, Then, Else } from 'react-if';
import { connect } from 'react-redux';
import { uploadAvailability, resetAvailability, updateAvailability } from '../../actions/availabilityAction';
import Spinner from '../../components/Spinner'
import SuccessPopup from './successPopup'
import FailedPopup from './failedPopup';

const PopupForm = ({ update, schedule, updateAvailability, resetAvailability, close, currentDay, uploadAvailability, loading, error, finished }) => {
    const [beschikbaar, updateBeschikbaar] = useState(update === true ? false : schedule.present || schedule.is_present === true ? true : false);
    const [day, updateDay] = useState(update === true ? '' : schedule.availability_shift_id === 1 ? true : false);

    useEffect(() => {
        resetAvailability()
    }, []);

    useEffect(() => {
        updateBeschikbaar(update === true ? false : schedule.present || schedule.is_present === true ? true : false)
        updateDay(update === true ? '' : schedule.availability_shift_id === 1 ? true : false)
    }, [schedule]);

    const handleSubmit = () => {
        const payload = {
            id: schedule.id,
            date: currentDay,
            is_present: beschikbaar === false ? 0 : 1,
            availability_shift_id: day === true ? 1 : 2
        }
        update === true ? uploadAvailability(payload) : updateAvailability(payload);
    }
    return (
        <div>
            <button
                style={{ color: "#EB5757" }}
                className={styles.close}
                onClick={close}
            >
                &times;
                    </button>
            <div className={styles.popupHeader}> Beschikbaarheid aanpassen </div>
            <If condition={!loading && !error && !finished}>
                <Then>
                    <div>
                        <p className={styles.bodyTitles}>Datum</p>
                        <p className={styles.formDate}>{formatToLetters(currentDay)}</p>
                        <p className={styles.bodyTitles}>Beschikbaar</p>
                        <div className={styles.checkboxContainer}>
                            <div>
                                <label for="Ja" className={styles.checkbox}>
                                    <input type="checkbox" checked={beschikbaar} onClick={() => updateBeschikbaar(true)} id="Ja" name="Ja" />
                                    <span> Ja</span>
                                </label>
                            </div>
                            <div>
                                <label for="Nee" className={styles.checkbox}>
                                    <input type="checkbox" checked={beschikbaar === false ? true : false} onClick={() => updateBeschikbaar(false)} id="Nee" name="Nee" />
                                    <span> Nee</span>
                                </label>
                            </div>
                        </div>
                        <If condition={beschikbaar === true ? true : false}>
                            <Then>
                                <p className={styles.bodyTitles}>Tijdstip</p>
                                <div className={styles.checkboxContainer2}>
                                    <div>
                                        <label for="heledag" className={styles.checkbox}>
                                            <input type="checkbox" checked={day} onClick={() => updateDay(true)} id="heledag" name="heledag" />
                                            <span> Hele dag</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label for="halvedag" className={styles.checkbox}>
                                            <input type="checkbox" checked={day === false ? true : false} onClick={() => updateDay(false)} id="halvedag" name="halvedag" />
                                            <span> Halve dag</span>
                                        </label>
                                    </div>
                                </div>
                            </Then>
                        </If>
                    </div>
                    <hr className={styles.underline} />
                    <div style={{ display: "flex", justifyContent: "space-between" }}>
                        <button className={styles.cancelBtn} onClick={close}>
                            <span className={styles.cancelBtnText}> Annuleren </span>
                        </button>
                        <button onClick={() => handleSubmit()} className={styles.confirmBtn} type="submit">
                            <span className={styles.confirmBtnText}>Opslaan </span>
                        </button>
                    </div>
                </Then>
                <Else>
                    <If condition={error}>
                        <FailedPopup />
                    </If>
                    <If condition={finished}>
                        <SuccessPopup />
                    </If>
                    <If condition={loading}>
                        <div className={styles.spinnerContainer}>
                            <Spinner />
                        </div>
                    </If>
                </Else>
            </If>
        </div>
    );

}
const mapStateToProps = state => ({
    loading: state.availability.loading,
    error: state.availability.error,
    finished: state.availability.finished,
    errorMessage: state.availability.errorMessage
})

export default connect(mapStateToProps, { uploadAvailability, resetAvailability, updateAvailability })(PopupForm);