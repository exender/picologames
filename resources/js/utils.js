import router from "./router"



export const authenticatedFetch = (method, path, data = {}) => {
    return axios({
        method: method,

        headers: {
            'Authorization': `Bearer ${localStorage.token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        url: path,
        data: data
    })
}


export const checkAdmin = () => {
    let id = parseInt(localStorage.token.substr(0, localStorage.token.indexOf('|')))
    authenticatedFetch('GET', `/api/token/${id}`)
        .then((res) => {
            authenticatedFetch('GET', `/api/user/${res.data}`).then((res) => {

                if (res.data !== 'admin') {
                    router.push({ name: 'Dashboard' })
                }
            })
        })

}


export const userId = async () => {

}
