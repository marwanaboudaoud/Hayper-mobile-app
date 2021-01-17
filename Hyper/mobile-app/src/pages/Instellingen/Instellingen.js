import React, { Component } from 'react'
import Menu from '../../components/menu/Menu'
import generalStyles from '../general.module.scss'
import { ButtonToolbar, DropdownButton, Dropdown } from 'react-bootstrap'
import styles from './index.module.scss'

class Instellingen extends Component {
  state = {}
  render () {
    return (
      <div
        className='container'
        style={{
          height: '100vh',
          justifyContent: 'unset',
          alignItems: 'unset'
        }}
      >
        <div className={generalStyles.header}>
          <Menu />
          <h4 className={generalStyles.headerTitle}>Instellingen</h4>
        </div>
        <div className={styles.dropdownContainer}>
          <ButtonToolbar style={{ fontWeight: 'bold' }}>
            <DropdownButton
              drop={'right'}
              title={'Accountgegevens'}
              id={'right'}
              key={'right'}
              className={styles.dropdown}
            >
              <Dropdown.Item eventKey='1'>Action</Dropdown.Item>
              <Dropdown.Item eventKey='2'>Another action</Dropdown.Item>
              <Dropdown.Item eventKey='3'>Something else here</Dropdown.Item>
              <Dropdown.Divider />
              <Dropdown.Item eventKey='4'>Separated link</Dropdown.Item>
            </DropdownButton>
          </ButtonToolbar>
          <ButtonToolbar>
            <DropdownButton
              drop={'right'}
              title={'Lorem ipsum'}
              id={'right'}
              key={'right'}
              className={styles.dropdown}
            >
              <Dropdown.Item eventKey='1'>Action</Dropdown.Item>
              <Dropdown.Item eventKey='2'>Another action</Dropdown.Item>
              <Dropdown.Item eventKey='3'>Something else here</Dropdown.Item>
              <Dropdown.Divider />
              <Dropdown.Item eventKey='4'>Separated link</Dropdown.Item>
            </DropdownButton>
          </ButtonToolbar>
        </div>
      </div>
    )
  }
}

export default Instellingen
