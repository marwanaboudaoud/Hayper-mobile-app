export const filterByName = (data, search) => data.filter(({name}) => name.toLowerCase().includes(search.toLowerCase()));

export const updatetoTableStructure = (data,blacklist) => {
    let headers = new Set();
    if(!blacklist) blacklist = []
    data.forEach(el => {
        for (const val of Object.keys(el)) {
            if( !(val in headers)){
                headers.add(val)
                blacklist.forEach(key => {
                    headers.delete(key)
                    delete el[key]
                })
            }
        }
    })
    return headers
}

export const blackListTable = (data,blacklist,whitelist) => {
    let headers = new Set();
    let body = [];
    if(!blacklist) blacklist = []
    if(whitelist) {
        data.forEach(el => {
            let response = {}
            whitelist.forEach(whitelist =>{
                for (const [val,key] of Object.entries(whitelist)) {
                if( !(val in headers)){
                    headers.add(key)
                }
                  response = {...response,[key]: el[val]}
                }
            })
            body.push(response)
        })
    }
    else {
        data.forEach(el => {
            for (const val of Object.keys(el)) {
                if( !(val in headers)){
                    headers.add(val)
                    blacklist.forEach(key => {
                        headers.delete(key)
                        delete el[key]
                    })
                }
            }
            body.push(el)
        })
    }
    
    return {headers,body}
}

export const resetKey = (obj,whitelist) => {
    let response;
    if(whitelist){
        whitelist.forEach(list => {
            for (const [val,key] of Object.entries(list)) {
               const objKey = Object.keys(obj)[0];
               if(objKey === key){
                 response = {[val] : obj[key]};
               }
           }
        })
        return response
    } return obj
}

export const resetKeyWithName = (name,whitelist) => {
    let response;
  if(whitelist){
    whitelist.forEach(list => {
        for (const [val,key] of Object.entries(list)) {
            if(name === key){
                response =  val;
            }
       }
    })
    return response
  } return name
}

export const resetKeyOrderBy = (name, updates) => {
    let res = name;
    updates.forEach(update => {
        for (const [val,key] of Object.entries(update)) {
            if(name == val){
                res = val;
            }
       }
    })
    return res;
};

export const resetToOriginal = (obj,whitelist) => {
    if(typeof(whitelist) === 'undefined'){
        return obj;

    }
    const object = {};
     Object.entries(obj).map((prop,i) => {
        const objVal = prop[1];
       return  object[Object.keys(whitelist[i])[0]] = objVal
    })
    return object;
    
}

export const resetToOriginalArray = (array,whitelist) => {
    if(typeof(whitelist) === 'undefined'){
        return array;
    }
    const res = array.map(obj => {
        const object = {};
         Object.entries(obj).map((prop,i) => {
            const objVal = prop[1];
        return  object[Object.keys(whitelist[i])[0]] = objVal
        })
        return object
    })
    return res;
    
}