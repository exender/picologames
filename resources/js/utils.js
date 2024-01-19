import router from "./router"



export const authenticatedFetch = (method, path, data = {}) => {


    return axios({
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${localStorage.token}`
        },
        url: path,
        data: data
    })
}


export const checkUser = () => {
    let id = parseInt(localStorage.token.substr(0, localStorage.token.indexOf('|')))
    authenticatedFetch('GET', `/api/token/${id}`)
        .then((res) => {
            authenticatedFetch('GET', `/api/user/${res.data}`).then((res) => {
                console.log(res.data)
                if (res.data !== 'admin') {
                    router.push({ name: 'Dashboard' })
                }
            })
        })

}
