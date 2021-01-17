import * as types from './types';
import history from '../utils/history';
import { axiosGET, axiosPOST, getHeader, axiosDownload } from '../utils/axios';
import { getToken } from '../utils/helpers';
import {updatetoTableStructure,blackListTable, resetKey, resetKeyWithName,resetKeyOrderBy, resetToOriginal} from '../utils/filter';
import store from '../utils/Store';
import axios from 'axios';
import {resetToOriginalArray} from '../utils/filter'
import { updateAppError } from './appActions';
const getState = () => store.getState();


export const setTableData = payload => dispatch => {
    const {table:{data:{api}}} = getState();
    const newApi = payload.api;
    dispatch({type:types.SET_TABLE_DATA, payload})
    if(newApi !== api){
        dispatch({type:types.RESET_TABLE})
    }
};

export const fetchTableData = () => (dispatch) => {
    const {table:{filters,data:{api}}} = getState();
    const initApi = api;
    getToken()
    .then(({token}) => {
        axiosPOST(api,filters,getHeader(token))
        .then(({data:{results,total_pages,total_items}}) => {
            const {table,table:{data:{api,blacklist,whitelist}}} = getState();
            if(api == initApi){
                const {headers,body} =   blackListTable(results,blacklist,whitelist);
                const currentHeaders = [...headers].length === 0 ? table.data.headers : [...headers];
                dispatch({type: types.UPDATE_TABLE_DATA, payload:{total_pages,total_items,headers:currentHeaders, body}})   
            }
        })
        .catch(e => dispatch({type: types.SET_TABLE_ERROR}))
})
}


export const updateTablePage = page => dispatch => {
    dispatch({type: types.UPDATE_TABLE_PAGE,payload:page})
}

export const setBodyLoading = () => dispatch =>{
    dispatch({type: types.SET_TABLE_BODY_LOADING})
};

export const updateTableSearch = (payload) => dispatch => {
    const {table:{data:{whitelist}}} = getState();
    const response = resetKey(payload,whitelist);
    dispatch({type: types.UPDATE_TABLE_SEARCH, payload:response})
};

export const updateTableSorting = payload => dispatch => {
    const {table:{data:{whitelist,custom_order_by},filters:{order_by,direction}}} = getState();
    const response = resetKeyWithName(payload,whitelist);
    // const customRes = resetKeyOrderBy(response,custom_order_by);
    const data = {
       direction: response === order_by ? direction === 'asc' ? 'desc' : 'asc' : 'asc',
       order_by:response
    }
    dispatch({type:types.UPDATE_TABLE_SORT_BY,payload:data})
    
};

export const deleteTableRow = id => dispatch => { 
    const {table:{data:{body,api,deletedItems,whitelist}}} = getState();
    const data = new Set([...deletedItems,id])
    dispatch({type:types.DELETE_TABLE_ROW, payload:[...data]})
    const newBody = resetToOriginalArray(body,whitelist).filter(el => el.id !== id)
    
    getToken()
    .then(({token}) => {
        axiosPOST(`${api}${id}/delete`,id,getHeader(token))
        .then(data => {
            dispatch({type:types.DELETE_TABLE_ROW, payload:[...deletedItems]})
            dispatch({type:types.DELETE_TABLE_ROW_SUCCESS, payload:newBody})
        })
        .catch(e => dispatch({type:types.DELETE_TABLE_ROW, payload:[...deletedItems]}))
    })
}

export const deleteTableRowNoReq = id => dispatch => {
    dispatch({type:types.DELETE_TABLE_ROW, payload:id})
}

export const downloadContract = (id) => dispatch => {
    const {table:{data:{body,api}}} = getState();
    const getDocumentNumber = () =>{
       const row =  body.find(({ID}) => ID === id);
       return row['Medewerker'];
    }
    
    getToken()
        .then(({token}) => {
            axiosPOST(`${api}download-contract`,{contract_id: id},{...getHeader(token), responseType: 'blob',})
            .then((data) => {
                const url = window.URL.createObjectURL(new Blob([data.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', `${getDocumentNumber()}-contract.pdf`);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            })
            .catch(e => updateAppError('Het contract is niet gevonden'))
        });
};

export const watchContract = (id) => dispatch => {
    const {table:{data:{whitelist,body,api}}} = getState();
    const getDocumentNumber = () =>{
       const row =  body.find(({ID}) => id);
       return row['document number'];
    }
    getDocumentNumber();
    getToken()
        .then(({token}) => {
            axiosPOST(`${api}download-contract`,{contract_id: id},{...getHeader(token), responseType: 'arraybuffer',})
            .then((data) => {
                var file = new Blob([data.data], {type: 'application/pdf'});
                var fileURL = URL.createObjectURL(file);
                window.open(fileURL);
            })
            .catch(e => updateAppError('Het contract is niet gevonden'))
        });
};


export const exportDataFromTable = () => dispatch => {
    dispatch({type:types.FETCHING_TABLE_EXPORT})
    const {table:{filters:{direction,order_by}}} = getState();
    getToken()
    .then(({token}) => {
        axiosPOST(`employees/export-generate`,{direction,order_by},getHeader(token))
        .then(({data:{url}}) => {
            axiosDownload(url)
            dispatch({type:types.FINISHED_FETCHING_TABLE_EXPORT})
        })
        .catch(e => dispatch({type:types.FINISHED_FETCHING_TABLE_EXPORT}) )
});
}


export const updateTableFilterExtension = data => dispatch => {
    dispatch({type:types.UPDATE_TABLE_FILTER_EXTENSION,payload:data})
}

export const updateTableFilter = () => dispatch => {
    dispatch({type:types.UPDATE_TABLE_FILTER})
};


export const updateExpiredContracts = (payload,cb) => dispatch => {
    getToken()
    .then(({token}) => {
        axiosPOST(`contracts/create-or-delete`,payload,getHeader(token))
        .then((res) => cb(true))
        .catch(e => cb(false));
    });
};
