import React, {useEffect, useState} from "react"
import {usePaginatedFetch} from "./hooks";
import tyre from "../serviceImages/tyre-change.jpg";
import brake from "../serviceImages/brake.jpg";
import engine from "../serviceImages/engine.jpg";
import entretien from "../serviceImages/entretien.jpg";
import electrique from "../serviceImages/electrique.jpg";
import Modal from "./Modal";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faArrowRight} from "@fortawesome/free-solid-svg-icons";

function Service() {
    const {items: services, load, loading} = usePaginatedFetch
    ('/api/services')

    const [groupedServices, setGroupedServices] = useState({});


    const categoryImages = {
        "PNEUMATIQUE & tenue de route": tyre,
        "FREINAGE & sécurité": brake,
        "MÉCANIQUE & diagnostics": engine,
        "ENTRETIEN & révision": entretien,
        "ÉLECTRIQUE & hybride": electrique,
    }

    const [isOpen, setIsOpen] = useState(false);
    const [selectedService, setSelectedService] = useState(null);

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
                if (service["is_approved"] === true) {
                    acc[category].push(service);
                }
                return acc;
            }, {});
            setGroupedServices(grouped);
        }
    }, [services]);

    const handleClose = (() => {
        setIsOpen(false);
    });

    const handleClick = ((service) => {
        setSelectedService(service);
        setIsOpen(true);
    });


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
                            {groupedServices[category].map((service, idx) => (
                                <li
                                    className="font-Barlow font-medium text-base text-slate-600 text-center"
                                    key={idx}
                                    onClick={()=>handleClick(service)}>
                                    {service.name}</li>
                            ))}
                        </ul>
                    </div>
                </div>
            ))}
            <Modal isOpen={isOpen}
                   handleClose={handleClose}>

                {selectedService && (
                    <>
                        <h2>{selectedService.name}</h2>
                        <p>{selectedService.content}</p>
                    </>
                )}

                <div className="lg:space-y-1 md:space-y-2 text-center my-auto">
                    <a href={"/contact"}
                       className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-auto">
                        Prendre rendez-vous <FontAwesomeIcon icon={faArrowRight}/>
                    </a>
                </div>

            </Modal>
        </div>
    )
}


export default Service;