import {usePaginatedFetch} from "./hooks";
import React, {useEffect} from "react";


const DayHours = React.memo(({dayHours: {amCloseHours, amOpenHours, day, pmCloseHours, pmOpenHours}}) => {
        return <div>
            <ul>
                <li>{day} : {amOpenHours} - {amCloseHours} / {pmOpenHours} - {pmCloseHours}</li>
            </ul>
        </div>
    }
)

function OpeningHours(){
    const {items: opening_hours, load, loading} = usePaginatedFetch
    ('/api/opening_hours')

    useEffect(() => {
            load()
        },
        [])

    return (
        <>
            {loading && 'Chargement...'}
            {opening_hours.map((o, index) => <DayHours key={index} dayHours={o}/>)}

        </>
    )
}

export default OpeningHours