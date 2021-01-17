import localforage from 'localforage';

export const hasToken = () => localStorage.getItem('token') ? true : false;
export const detectRuntime = (dev,pro) => !process.env.NODE_ENV || process.env.NODE_ENV === 'development' ? dev : pro;
export const serverURL = process.env.REACT_APP_API_HOST;
export const apiCall = (url) => `${serverURL}/api/${url}`
export const setToken = token => localforage.setItem('token',token);
export const getToken = async () => await localforage.getItem('token');
export const removeToken = () => localforage.removeItem('token');
export const toDutchValue = number => `€ ${parseFloat(number).toFixed(2).replace('.',',')}`
export const isNotEmpty = data => {
    console.log(data)
}

export const removeItemByIndex = (data,i) => data.filter((el,index) => index !== i)
export const updateItemByIndex = (data,index,name,value) => data.map((el,i) => i == index ? {...el,[name] : value} : el)