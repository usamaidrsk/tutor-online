export default function (error) {
    console.error(error.response || error)

    document.scrollingElement.scrollTo({ top: 0, behavior: 'smooth' })

    if (error.response) {
        const { errors } = error.response.data
        return errors || {}
    }

    return {}
}
