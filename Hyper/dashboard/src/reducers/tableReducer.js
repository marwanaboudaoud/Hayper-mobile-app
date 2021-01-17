import * as types from '../actions/types';
import { getCurrentMonth, getCurrentYear } from '../utils/Date';


const initialState = {
    data:{
        api:null,
        error:false,
        headers:[],
        body:[],
        loading:true,
        deletedItems:[],
        bodyLoading:true,
        exportLoading:false,
        fetching:false, 
        total_items:1,
        total_pages: 1,
    },
    filters:{
        page:1,
        limit:15,
        direction: 'asc',
        order_by: 'id',
        search:{},
        filter:{
            month: '',
            year: ''
        }
    },
};

export const tableReducer = (state = initialState , {type,payload})=>{
    switch (type) {
        case types.SET_TABLE_DATA:
            return {...state, data:{...state.data,...payload},filters:{...state.filters,page:1,limit:15,direction: 'asc',order_by: 'id',search:{}}}
        case types.RESET_TABLE:
            return {...state, data:{...state.data,body:[],headers:[],bodyLoading:true,loading:true,error:false}}
        case types.UPDATE_TABLE_DATA:
            return {...state,data:{...state.data,...payload,bodyLoading:false,loading:false,deletedItems:[],error:false}}
        case types.SET_TABLE_ERROR:
            return {...state, data:{...state.data,error:true,loading:false,bodyLoading:false}}
        case types.UPDATE_TABLE_PAGE:
            return {...state,filters:{...state.filters,page:payload},data:{...state.data, bodyLoading:true}}
        case types.UPDATE_TABLE_SEARCH:
            return {...state,filters:{...state.filters,search:{...state.filters.search, ...payload},page:1}}
        case types.SET_TABLE_BODY_LOADING:
            return {...state,data:{...state.data,bodyLoading:true}}
        case types.UPDATE_TABLE_SORT_BY:
            return {...state,filters:{...state.filters,...payload}}
        case types.DELETE_TABLE_ROW:
            return {...state, data:{...state.data,deletedItems:payload} }
        case types.UPDATE_TABLE_FILTER_EXTENSION:
            return {...state,data:{...state.data,bodyLoading:true},filters:{...state.filters,filter:{...state.filters.filter,...payload}}} 
        case types.FETCHING_TABLE_EXPORT:
            return {...state,data:{...state.data,exportLoading:true}}
        case types.FINISHED_FETCHING_TABLE_EXPORT:
            return {...state,data:{...state.data,exportLoading:false}}
        case types.DELETE_TABLE_ROW_SUCCESS:
            return {...state,data:{...state.data,total_items:(state.data.total_items - 1),body:payload,total_items:(state.data.total_items - 1)}}
        case types.UPDATE_TABLE_FILTER:
            return {...state,filters:{...state.filters,filter:{'month' : getCurrentMonth(),'year': getCurrentYear() }}}
            default:
            return state;

    }
};