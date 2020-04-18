const { baseURL, routes } = window

module.exports = (url, ...params) => {
    const name = routes[url]

    if (name === undefined) {
        throw new Error(`Route not found: '${url}'`)
    }

    return (
        baseURL +
        '/' +
        name
            .split('/')
            .map(s => (s.startsWith('{') ? params.shift() : s))
            .join('/')
    )
}
