import React, {useEffect, useState} from "react"
import {usePaginatedFetch} from "./hooks";
import tyre from "../serviceImages/tyre-change.jpg";
import brake from "../serviceImages/brake.jpg";
import engine from "../serviceImages/engine.jpg";
import entretien from "../serviceImages/entretien.jpg";
import electrique from "../serviceImages/electrique.jpg";

function Service() {
    const {items: services, load, loading} = usePaginatedFetch
    ('/api/services')

    const [groupedServices, setGroupedServices] = useState({});

    const categoryImages = {
        "PNEUMATIQUE & tenue de route": tyre,
        "FREINAGE & sécurité": brake,
        "MÉCANIQUE & diagnostics": engine,
        "ENTRETION & révision": entretien,
        "ÉLECTRIQUE & hybride": electrique,
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
        <div className="grid md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-5 grid-cols-1 gap-6">
            {loading && 'Chargement...'}

            {Object.keys(groupedServices).map((category, index) => (
                <div key={index} className="bg-white rounded-lg">

                    <img
                        className=" rounded-t-lg"
                        src={categoryImages[category]}
                        alt={`Image pour la catégorie ${category}`}/>
                    <div className="m-8">
                        <h2
                            className="font-Barlow font-medium text-lg text-slate-400 text-center rounded-b-lg">
                            {category}
                        </h2>
                        <ul className="mt-6">
                            {groupedServices[category].map((serviceName, idx) => (
                                <li
                                    className="font-Barlow font-medium text-base text-slate-600 text-center"
                                    key={idx}> {serviceName}</li>
                            ))}
                        </ul>
                    </div>
                </div>
            ))}
        </div>
    )
}


export default Service;

// TODO : margin card