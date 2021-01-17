import React, { useState, useEffect } from 'react'
import ProjectInput from './ProjectInput';
import ProjectSelect from './ProjectSelect';
import { connect } from 'react-redux';
import { addScheduleToProject, updateScheduleOfProjects } from '../../actions/projectAction';
import ProjectDelete from './ProjectDelete';
import ProjectApply from './ProjectApply';
import Check from '../../assets/img/icons/check.svg';
import ProjectBottom from './ProjectBottom';
import ProjectSearch from './ProjectSearch';
import ProjectChosen from './ProjectChosen';
import ProjectDriverInput from './ProjectDriverInput';
const ProjectEdit = ({ updateScheduleOfProjects, addScheduleToProject, toggleShow, name, projectId, date, update, schedule }) => {
    console.log(schedule);
    const [address, updateAddress] = useState(update === true ? schedule.address : '');
    const [postcode, updatePostcode] = useState(update === true ? schedule.postcode : '');
    const [city, updateCity] = useState(update === true ? schedule.city : '');
    const [shift, updateShift] = useState(update === true ? schedule.availability_shift_id : 1);
    const [employees, updateEmployee] = useState(update === true ? schedule.employees : []);
    const [driver, updateDriver] = useState(update === true ? schedule.driver : {});
    const [chosenDriver, updateChosenDriver] = useState(update === true ? false : true);
    const [submit, updateSubmited] = useState(false)

    const handleSubmit = e => {
        e.preventDefault();
        let employeesIds = employees.map(employee => employee.id)
        let payload = { date, address, postcode, city, employees: employeesIds, driver, name: address, project_id: projectId }
        payload.driver = payload.driver.id

        updateSubmited(true)
        setTimeout(() => updateSubmited(false), 750)
        if (address && postcode && city && employees.length > 0 && driver) {
            if (update) {
                return updateScheduleOfProjects(schedule.id, payload)
            }
            return addScheduleToProject(payload)
        }

    };

    const handleUpdate = data => {
        updateEmployee(oldArray => [...oldArray, data])
    }

      const handleDelete = id => {
          updateEmployee(oldArray => oldArray.filter(el => el.id !== id))
      }

    return (
        <div className="project__edit">
            <p>Shiftlocatie toevoegen</p>
            <form className="project__form" onSubmit={e => handleSubmit(e)}>
                <ProjectInput submit={submit} value={address} onChange={(value) => updateAddress(value)} placeholder={'Vul adres...'} />
                <ProjectInput submit={submit} value={postcode} onChange={(value) => updatePostcode(value)} placeholder={'Vul postcode... '} />
                <ProjectInput submit={submit} value={city} onChange={(value) => updateCity(value)} placeholder={'Vul stad...'} />
                <ProjectSelect shift={shift} changeShift={value => updateShift(value)} />
                <ProjectSearch shift={shift} date={date} submit={submit} handleUpdate={(value) => handleUpdate(value)} chosenEmployees={employees} placeholder={'Zoek werknemer...'} />
                <ProjectDriverInput shift={shift} date={date} submit={submit} handleUpdate={(value) => updateDriver(value)} chosenEmployees={employees} chosenDriver={chosenDriver} driver={driver} updateChosenDriver={(option) => updateChosenDriver(option)} placeholder={'Zoek chauffeur...'} />
                <ProjectChosen onDelete={(id) => handleDelete(id)} employees={employees} />
                <ProjectBottom>
                    <ProjectApply type={'submit'} icon={Check} text={'Inplannen'} />
                    <ProjectDelete click={() => toggleShow()} text="Annuleren" />
                </ProjectBottom>
            </form>
        </div>
    );
}

export default connect(null, { addScheduleToProject, updateScheduleOfProjects })(ProjectEdit);