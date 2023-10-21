import {usePaginatedFetch} from "./hooks";
import React, {useEffect} from "react";


const GaragesArea = React.memo(({garagesArea: {name, address, zipcode, city, phone, email}}) => {
        return <div>
                <p>Par téléphone : {phone}</p>
                <p>Par email : {email}</p>
                <p>Adresse postale : {address}</p>
                <p>{zipcode} {city}</p>
        </div>
    }
)

function Address(){
    const {items: garages, load, loading, count, hasMore} = usePaginatedFetch
    ('/api/garages')

    useEffect(() => {
            load()
        },
        [])

    return (
        garages.map((g, index) => <GaragesArea key={index} garagesArea={g}/>)
    )
}

export default Address

// TODO: mettre email dans bdd garage ????