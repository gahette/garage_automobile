import {useCallback, useState} from "react";

export function useServicesFetch(url) {
    const [loading, setLoading] = useState(false)
    const [items, setItems] = useState([])
    const [count, setCount] = useState(0)
    const load = useCallback(async function () {
        setLoading(true)
        const response = await fetch(url, {
            headers: {
                'Accept': 'application/ld+json'
            }
        })
        const responseData = await response.json()
        if (response.ok) {
            setItems(responseData['hydra:member'])
            setCount(responseData['hydra:totalItems'])
        } else {
            console.error(responseData)
        }
        setLoading(false)
    }, [url])
    return{
        items,
        load,
        count,
        loading,
    }
}