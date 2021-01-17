import Moment from "moment";
import 'moment/locale/nl';





const weekNumber = (option, date) => {
  const moment = Moment(date);
  return moment
    .add(option, "week")
    .week()
    .toString();
};

const yearNumber = (option, date) => {
  const moment = Moment(date);
  return moment
    .add(option, "week")
    .year()
    .toString();
};

const monthNumber = (date) => {
  const moment = Moment();
  return moment
    .add(date, "month")
    .format('MMMM Y')
};

const startOfWeek = (option, format) => {
  const moment = Moment();
  return moment
    .startOf("week")
    .add(0, "d")
    .add(option, "week")
    .format(format);
};
const endOfWeek = (option, format) => {
  const moment = Moment();
  return moment
    .endOf("week")
    .add(0, "d")
    .add(option, "week")
    .format(format);
};

export const getToday = () => Moment().format("YYYY-MM-DD");

export const formatToLetters = date => Moment(date).format('dddd D MMMM YYYY')
export const formatDayToNaL = date => Moment(date).format('DD/MM - ');
export const formatDayToNaL2 = date => Moment(date).format('dddd');
export const formatDayToNaLSalaris = date => Moment(date).format('DD/MM - dddd');


export const getCurrentWeek = option => {
  return {
    year: yearNumber(option),
    week: weekNumber(option),
    startOfWeek: startOfWeek(option, 'DD/MM'),
    endOfWeek: endOfWeek(option, "DD/MM")
  };
};

export const getCurrentMonth = option => {
  return {
    year: yearNumber(option, 'YYYY'),
    month: monthNumber(option),
    startOfWeek: startOfWeek(option, 'MM/DD'),
    endOfWeek: endOfWeek(option, "MM/DD")
  };
};


export const getThisMonth = option => {
  const month = Moment().add(option, 'month')

  return {
    month: monthNumber(option),
    startOfMonth: month.startOf('month').format('YYYY-MM-DD'),
    endOfMonth: month.endOf('month').format('YYYY-MM-DD'),
  };

};

export const getWeek = option => {
  return {
    year: yearNumber(option),
    week: weekNumber(option),
    startOfWeek: startOfWeek(option, 'YYYY-MM-DD'),
    endOfWeek: endOfWeek(option, 'YYYY-MM-DD')
  };
}

export const formatYear = year => ({
  year: yearNumber(0, year),
  week: weekNumber(0, year)
});

export const formatToDay = (date, schedules, cb) => {
  const { year, week } = date;
  let defaultWeekdays = [];
  for (let i = -1; i < 6; i++) {
    defaultWeekdays.push({
      formatedDate: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("ddd D/0M"),
      date: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("YYYY-MM-DD"),
      day: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("D"),
      dayLetter: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("dd"),
    });
  }

  const sortedArray = defaultWeekdays.map(day => {
    const filtered = schedules.filter(({ date }) => date === day.date);
    return { ...day, schedules: filtered };
  });
  return sortedArray;
};

export const formatToBeschikbaarHeid = (date, schedules) => {
  const { year, week } = date;
  let defaultWeekdays = [];

  for (let i = -1; i < 6; i++) {
    defaultWeekdays.push({
      formatedDate: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("ddd D/0M"),

      date: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("YYYY-MM-DD"),

      day: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("D"),

      dayLetter: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("dd"),
    });
  }

  const sortedArray = defaultWeekdays.map(day => {
    let filtered = schedules.find(({ date }) => date === day.date);
    if (!filtered) {
      filtered = {}
    }
    return { ...day, schedules: filtered };
  });
  return sortedArray;
};

export const formatMySalariesDays = (date, salaries) => {
  const { year, week } = date;
  let defaultWeekdays = [];

  for (let i = -1; i < 6; i++) {
    defaultWeekdays.push({
      formatedDate: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("ddd D/0M"),

      date: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("YYYY-MM-DD"),

      day: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("D"),

      dayLetter: Moment(year)
        .add(week - 1, "weeks")
        .startOf("week")
        .add(i + 1, "days")
        .format("dd"),
    });
  }

  const sortedArray = defaultWeekdays.map(day => {
    let currentSalary = []
    salaries.forEach(salary => salary.salary_days.forEach(salary => {
      if (day.date === salary.date) {
        currentSalary.push(salary)
      }
    }))
    return { ...day, salaries: currentSalary };
  });


  return sortedArray;
};
