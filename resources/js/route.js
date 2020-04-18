const { baseURL, routes } = window

module.exports = (url, ...params) => {
    let name = routes[url]

    if (name === undefined) {
        throw new Error(`Route not found: '${url}'`)
    }

    if (name.startsWith('/')) name = name.slice(1)

    return (
        baseURL +
        '/' +
        name
            .split('/')
            .map(s => (s.startsWith('{') ? params.shift() : s))
            .join('/')
    )
}
