export const returnResponse = ({errors,message}) => {
    let response = [];
    if(errors){
        for (const [key, value] of Object.entries(errors)) {
            value.forEach(v => response.push(v))
        }
    } else {
        response.push(message)
    }

    return response
};