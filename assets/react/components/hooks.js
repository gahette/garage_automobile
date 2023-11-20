import {useCallback, useEffect, useState} from "react";

async function jsonLdFetch(url, method = "GET", data = null) {
    const params = {
        method: method, headers: {
            'Accept': 'application/ld+json', 'Content-Type': 'application/json'
        }
    }

    if (data) {
        params.body = JSON.stringify(data)
    }
    const response = await fetch(url, params)
    if (response.status === 204) {
        return null
    }
    const responseData = await response.json()
    if (response.ok) {
        return responseData
    } else {
        throw responseData
    }
}


export function usePaginatedFetch(url) {
    const [loading, setLoading] = useState(false)
    const [items, setItems] = useState([])
    const [count, setCount] = useState(0)
    const [next, setNext] = useState(null)
    const [previous, setPrevious] = useState(null)
    const load = async () => {
        setLoading(true)
        try {
            const response = await jsonLdFetch(next || url)

            setItems(response['hydra:member']);

            setCount(response['hydra:totalItems'])

            if (response['hydra:view'] && response['hydra:view']['hydra:next']) {
                setNext(response['hydra:view']['hydra:next'])
            } else {
                setNext(null)
            }

            if (response['hydra:view'] && response['hydra:view']['hydra:previous']) {
                setPrevious(response['hydra:view']['hydra:previous'])
            } else {
                setPrevious(null)
            }

        } catch (error) {
            console.error(error)
        } finally {
            setLoading(false);
        }
    };

    return {
        items, load, count, loading, hasMore: next !== null, hasLess: previous !== null
    }
}


const fetchImagePath = async (imageId) => {
    // À adapter en fonction de votre logique réelle
    const response = await fetch(`/api/images/${imageId}`);
    const data = await response.json();
    return data.path;
};

export const useImagePath = (imageId) => {
    const [imagePath, setImagePath] = useState(null);

    useEffect(() => {
        const getImagePath = async () => {
            try {
                const path = await fetchImagePath(imageId);
                setImagePath(path);
            } catch (error) {
                console.error('Error fetching image path:', error);
            }
        };

        if (imageId) {
            getImagePath();
        }
    }, [imageId]);

    return imagePath;
};

export function useFetch(url, method = "POST", callback = null) {
    const [errors, setErrors] = useState({});
    const [loading, setLoading] = useState(false);

    const load = useCallback(async (data = null) => {
        setLoading(true)
        try {
            const response = await jsonLdFetch(url, method, data)
            if (callback) {
                callback(response)
            }
        } catch (error) {
            if (error.violations) {
                setErrors(error.violations.reduce((acc, violation) => {
                    acc[violation.propertyPath] = violation.message
                    return acc
                }, {}));
            } else {
                console.error("Error violations not found:", error);
            }
        }
        setLoading(false)
    }, [url, method, callback]);
    return {
        loading, errors, load
    }
}