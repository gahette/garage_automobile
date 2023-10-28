import React, {useEffect, useState} from "react"
import {usePaginatedFetch} from "./hooks";
import tyre from "../serviceImages/tyre-change.jpg";
import brake from "../serviceImages/brake.jpg";


function Service() {
    const {items: services, load, loading} = usePaginatedFetch
    ('/api/services')

    const [groupedServices, setGroupedServices] = useState({});

    const categoryImages = {
        "PNEUMATIQUE & tenue de route": tyre,
        "FREINAGE & sécurité": brake,
    }

    useEffect(() => {
            load()
        },
        [])

    useEffect(() => {
        if (services.length > 0) {
            const grouped = services.reduce((acc, service) => {
                const category = service["category"];
                if (!acc[category]) {
                    acc[category] = [];
                }
                if (service.is_approved === true) {
                    acc[category].push(service.name);
                }
                return acc;
            }, {});
            setGroupedServices(grouped);
        }
    }, [services]);


    return (
        <div className="grid grid-cols-5 gap-6">
            {loading && 'Chargement...'}

            {Object.keys(groupedServices).map((category, index) => (
                <div key={index} className="bg-slate-400 rounded">

                    <img
                        className=" rounded-t"
                        // width={241.6}
                        src={categoryImages[category]}
                        alt={`Image pour la catégorie ${category}`}/>


                    <h2
                        className="mx-4">
                        {category}
                    </h2>
                    <ul>
                        {groupedServices[category].map((serviceName, idx) => (
                            <li
                                className="mx-4"
                                key={idx}> {serviceName}</li>
                        ))}
                    </ul>
                </div>
            ))}
        </div>
    )
}


export default Service;

// TODO : margin card