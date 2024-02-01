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
                console.log(res)

                if (res.data.role !== 'admin') {
                    router.push({ name: 'Dashboard' })
                }
            })
        })

}

export const checkId = async () => {
    let tokenId = parseInt(localStorage.token.substr(0, localStorage.token.indexOf('|')))
    let id = null
    await authenticatedFetch('GET', `/api/token/${tokenId}`)
        .then((res) => {
            id = res.data
        })
    console.log(id)
    return Number(id)
}
