import React,{useState,useEffect} from 'react'
import {updateProjectDate} from '../../actions/projectAction';
import {connect} from 'react-redux'
import './style.scss';
import Polygon from '../../assets/img/icons/polygon.svg';
import {getCurrentWeek} from '../../utils/Date';


class WeekplanningDate extends React.Component {
        state = {
            setter: this.props.setter,
            date: this.props.initDate,
            disabled: false,
            fixed:false,
        }

        incrementWeek = () => {

        this.setState({setter: this.state.setter + 1},
            () => {
                this.setState({date: getCurrentWeek(this.state.setter)},() =>{
                    this.checkDecrement(this.state.date);
                    this.props.updateProjectDate(this.state.date,this.state.setter)
                })
            }
            )
       }

       componentDidMount(){
        document.getElementById('scroll').addEventListener('scroll', this.handleScroll.bind(this));
       }

       componentDidUpdate(prevProps,prevState){
        if(JSON.stringify(prevProps) !== JSON.stringify(this.props)){
            this.setState({
                setter: prevState.setter,
                date: this.props.initDate
            })
        }
    }

    
    componentWillUnmount() {
        document.getElementById('scroll').removeEventListener('scroll', this.handleScroll.bind(this));
    }

    handleScroll(event) {
        event.preventDefault();
        const top = document.getElementById('scroll').scrollTop;
        if(top < 3 && this.state.fixed === true ) {
            this.setState({fixed: false})
        } else if (top >=  3 && this.state.fixed !== true) {
            this.setState({fixed: true})
        }
        
    }

       decrementWeek = () => {
        if(!this.checkDecrement(this.state.date)){
            this.setState({setter: this.state.setter - 1}, () => {
                this.setState({date: getCurrentWeek(this.state.setter)},() =>{
                    this.props.updateProjectDate(this.state.date,this.state.setter)
                })
            })
        }
       }

       checkDecrement = (date) => date.year === '2020' && date.week === '1' ? true : false;
       
       render(){
           const {date,setter,fixed} = this.state;
        return (
            <div className={"weekplanning__date" + (fixed ? ' weekplanning__date-fixed' : ' ')}>
                <div onClick={() => this.decrementWeek()}  className={"weekplanning__button weekplanning__button-left " + (this.checkDecrement(date) ? ' weekplanning__button-disabled': '')}><img src={Polygon}/></div>
                <div className="weekplanning__currentDate"><span className="weekplanning__bold">Week {date.week}</span> | {date.startOfWeek} - {date.endOfWeek}</div>
                <div onClick={() => this.incrementWeek()} className="weekplanning__button weekplanning__button-right"><img src={Polygon}/></div>
            </div>
        )
       }
}

function mapStateToProps(state) {
    return {
        initDate: state.projects.date,
        setter: state.projects.setter
    };
}
export default connect(mapStateToProps,{updateProjectDate})(WeekplanningDate);

