import React, { useEffect } from 'react';
import './style.scss';
import { connect } from 'react-redux';
import Layout from '../../components/Layout'
import {fetchProjects} from '../../actions/projectAction';
import Projects from '../../components/Projects/Projects'
import WeekplanningHeader from '../../components/Weekplanning/WeekplanningHeader';
import WeekplanningCities from '../../components/Weekplanning/WeekplanningCities';
import {If, Then,Else} from 'react-if';
import Spinner from '../../components/Spinner';
import {getCurrentWeek} from '../../utils/Date';
import TableError from '../../components/Table/TableError';
class Weekplanning extends React.Component{
        state= {
            loading: this.props.loading,
            projects: this.props.projects,
            date: this.props.date,
            error: this.props.error,
        }

        componentDidUpdate(prevProps){
            if(JSON.stringify(prevProps) !== JSON.stringify(this.props)){
                this.setState({
                    loading: this.props.loading,
                    projects: this.props.projects,
                    date: this.props.date,
                    error: this.props.error,
                }, () => {
                    const {date:{year,week}} = this.state;
                    this.props.fetchProjects({year,week});
                })
            }
        }

        componentDidMount(){
            const {date:{year,week}} = this.state;
            this.props.fetchProjects({year,week});
        }


        render() {
            const {loading,projects,error} = this.state;
            return (
            <Layout loading={loading}>
                <If condition={error}>
                    <Then><TableError/></Then>
                    <Else>
                        <If condition={loading}>
                            <Then>
                             <Spinner/>
                            </Then>
                            <Else>
                                <WeekplanningHeader/>
                                {/* <WeekplanningCities cities={projects}/> */}
                                <Projects projects={projects}/>
                            </Else>
                        </If>
                    </Else>
                </If>
            </Layout>
        )
    }

}

function mapStateToProps(state) {
    return {
        loading: state.projects.loading,
        date: state.projects.date,
        projects: state.projects.projects,
        error: state.projects.error,
    };
}

export default connect(mapStateToProps,{fetchProjects})(Weekplanning)