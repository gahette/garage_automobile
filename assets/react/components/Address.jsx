import {usePaginatedFetch} from "./hooks";
import React, {useEffect} from "react";


const GaragesArea = React.memo(({garagesArea: {address, zip_code, city, phone, email}}) => {
        return <div>
                <p>Par téléphone : {phone}</p>
                <p>Par email : {email}</p>
                <p>Adresse postale : {address}</p>
                <p>{zip_code} {city}</p>
        </div>
    }
)

function Address(){
    const {items: garages, load, loading} = usePaginatedFetch
    ('/api/garages')

    useEffect(() => {
            const fetchData = async () => {
                await load();
            };
            fetchData().then(() => {

            });
        },
        []);

    return (
        <>
            {loading && 'Chargement...'}
            {garages.map((g, index) => <GaragesArea key={index} garagesArea={g}/>)}
        </>

    )
}

export default Address