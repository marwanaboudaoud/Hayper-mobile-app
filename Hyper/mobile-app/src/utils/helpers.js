import localforage from 'localforage'

export const hasToken = () => (localStorage.getItem('token') ? true : false)
export const detectRuntime = (dev, pro) => !process.env.NODE_ENV || process.env.NODE_ENV === 'development' ? dev : pro
export const serverURL = process.env.REACT_APP_API_HOST;
export const apiCall = url => `${serverURL}/api/${url}`
export const setToken = token => localforage.setItem('token', token)
export const getToken = () => localforage.getItem('token')
export const removeToken = () => localforage.removeItem('token')
export const isObjectEmpty = obj => Object.entries(obj).length === 0 ? true : false