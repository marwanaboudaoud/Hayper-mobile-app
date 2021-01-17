import Moment from 'moment';

const weekNumber = (option,date) => {
    const moment = Moment(date)
    return moment.add(option, 'week').isoWeek().toString();
};

const yearNumber = (option,date) => {
    const moment = Moment(date)
    return moment.add(option, 'week').isoWeekYear().toString();
};

const startOfWeek = (option,date) => {
    const moment = Moment(date)
    return moment.startOf('week').add(1, 'd').add(option, 'week').format('D MMMM');
}
const endOfWeek = (option,date) => {
    const moment = Moment(date)
    return moment.endOf('week').add(1, 'd').add(option, 'week').format('D MMMM');
}

export const getToday = () => Moment().format('YYYY-MM-DD')



export const getCurrentWeek = (option,) =>{
    return ({ year: yearNumber(option,), week:weekNumber(option),startOfWeek:startOfWeek(option),endOfWeek:endOfWeek(option)})
} 

export const formatYear = (year) => ({year:yearNumber(0,year),week:weekNumber(0,year)})

export const formatMonth = (year,week,i) => {
    let day = Moment(year).add((week - 1),'weeks').startOf('week').add((i + 1), 'days').format('ddd D/');
    let month = Moment(year).add((week - 1),'weeks').startOf('week').add((i + 1), 'days').format('M')
    if(month.length === 1){
        month = `0${month}`
    }
    return `${day}${month}`
}
export const formatToDay = (date, schedules) => {
    const {year,week} =date;
    let defaultWeekdays = []
    for(let i = 0; i < 7; i++){
        defaultWeekdays.push({
            formatedDate : formatMonth(year,week,i),
            date: Moment(year).add((week - 1),'weeks').startOf('week').add((i + 1), 'days').format('YYYY-MM-DD')
        })
    }
    
    const sortedArray = defaultWeekdays.map(day => {
        const filtered = schedules.filter(({date}) => date === day.date)
        return({...day , schedules:filtered})
    })
    return sortedArray
}



export const getFilterMonthsWithYear = () => {
    const currentMonth = Moment().format('MMMM')
    let months = [];
    Array.apply(0, Array(12)).map((_,i) => {
         const month = Moment().month(i).format('MMMM');
         const monthNumber = Moment().month(i).format('M');
         const isDefault = (month.toString() === currentMonth.toString() ? true : false)
         months.push({month ,monthNumber, isDefault});
    });
    return months;
}

export const getYearsFromBeginningTillEnd = () => {
    const start = Moment('2019-01-01');
    const end = Moment();
    var years = end.diff(start, 'years');
    var yearsBetween = [];
    for(let i = 0 ;i <= years; i++)  {
        const year = parseInt(Moment('2019-01-01').add(i,'year').format('YYYY'));
        const currentYear = parseInt(Moment().format('YYYY'));
        yearsBetween.push({
            year,
            isDefault: currentYear === year ? true : false
        })
    }  
    return yearsBetween;
};

export const getCurrentMonth = () => parseInt(Moment().format('M'));
export const getCurrentYear = () =>  parseInt(Moment().format('YYYY'));

export const formatToDutch = (date) => {
    const moment = Moment(date);
    return moment.format('DD-MM-YYYY')
}

export const validateDate = date => {
    const moment = Moment(date,'YYYY-MM-DD',true);
    return moment.isValid();
}

export const addMonth = date => {
    const moment = Moment(date);
    return moment.add(1,'M').format('DD-MM-YYYY')
};