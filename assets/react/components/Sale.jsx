import React, {useEffect, useState} from 'react';
import {useImagePath, usePaginatedFetch} from './hooks';
import "react-responsive-carousel/lib/styles/carousel.min.css";
import {Carousel} from "react-responsive-carousel";
import Modal from "./Modal";
import ContactModal from "./ContactModal";
import ContactForm from "./ContactForm";

function Sale(){
    const {items: cars, load, hasMore, hasLess, loading} = usePaginatedFetch('/api/cars');

    useEffect(() => {
            const fetchData = async () => {
                await load();
            };
            fetchData().then(() => {

            });
        },
        []);

    const loadMore = async () => {
        if (hasMore) {
            await load(); // Charger plus de voitures lorsque le bouton "Load More" est cliqué
        }
    };

    const loadLess = async () => {
        if (hasLess) {
            await load();
        }
    }

    return (<div>
        {loading && 'Chargement...'}
        <div className="my-16">
            <ul className="grid md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-5 grid-cols-1 gap-6">
                {cars.map((car) => (
                    <CarItem key={car.id} car={car}>
                        <ContactForm carId={car.id} car={car}/>
                    </CarItem>
                ))}
            </ul>
        </div>
        <div className="lg:space-y-1 md:space-y-2 text-center my-auto">
            {hasMore && (<button
                className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-auto"
                onClick={loadMore} disabled={loading}>
                {loading ? 'Chargement...' : 'Suivant'}
            </button>)}
            {hasLess && (<button
                className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-auto"
                onClick={loadLess} disabled={loading}>
                {loading ? 'Chargement...' : 'Précédent'}
            </button>)}
        </div>
    </div>);
}

const CarItem = ({car}) => {
    const [isOpen, setIsOpen] = useState(false);
    const [isContactModalOpen, setContactModalOpen] = useState(false);

    const handleClose = (() => {
        setIsOpen(false);
    });

    const handleClick = (() => {
        setIsOpen(true);
    });

    const handleCloseContactModal = () => {
        setContactModalOpen(false);
    };

    const handleOpenContactModal = () => {
        setContactModalOpen(true);
    };

    return (

        <ul>

        <li key={`car_${car.id}`} className="bg-white rounded-lg">

            <div>
                {car.images && car.images.length > 0 && (

                    <div>
                        {car.images && car.images.length > 1 ? (

                            <Carousel
                                interval={3000}
                                autoPlay={true}
                                infiniteLoop
                                showIndicators={false}
                                showStatus={false}
                                showArrows={false}
                                showThumbs={true}
                            >

                                {car.images.map((slide, index) => {
                                    const imageId = slide.match(/\/(\d+)$/)[1];
                                    const imagePath = useImagePath(imageId);
                                    return (


                                        <img
                                            key={`car_${car.id}_image_${index}`}
                                            src={`/api/images/${imagePath}`}
                                            // width={240}
                                            alt={"image de la voiture"}
                                            className=" rounded-t-lg"
                                        />


                                    );
                                })}

                            </Carousel>

                        ) : (<div>
                            {car.images.map((slide, index) => {
                                const imageId = slide.match(/\/(\d+)$/)[1];
                                const imagePath = useImagePath(imageId);
                                return (

                                    <img
                                        key={`car_${car.id}_image_${index}`}
                                        src={`/api/images/${imagePath}`}
                                        // width={240}
                                        alt={"image de la voiture"}
                                        className=" rounded-t-lg"
                                    />

                                );
                            })}
                        </div>)}
                    </div>)}
            </div>

            <div className="mb-8">
                <h2 className="font-Barlow font-medium text-lg text-slate-400 text-center rounded-b-lg">{car.name}</h2>

                <ul className="mt-6">
                    <li className="font-Barlow font-medium text-base text-slate-600 text-center">Marque: {car.brand}</li>
                    <li className="font-Barlow font-medium text-base text-slate-600 text-center">Modèle: {car.model}</li>
                    <li className="font-Barlow font-medium text-base text-slate-600 text-center">Kilométrage: {car["kilometer"]}</li>
                    <li className="font-Barlow font-medium text-base text-slate-600 text-center">Année: {car.year}</li>
                </ul>

                <div className="lg:space-y-1 md:space-y-2 my-auto">
                    <div>

                        <Modal
                            isOpen={isOpen}
                            handleClose={handleClose}
                        >
                            <div className="overflow-hidden">
                                <h2 className="font-Barlow font-medium text-lg text-slate-400 text-center rounded-b-lg">{car.name}</h2>

                                <ul className="mt-6">
                                    <li className="font-Barlow font-semibold text-base text-slate-600">Modèle: <p
                                        className="font-normal">{car.model}</p></li>
                                    <li className="font-Barlow font-semibold text-base text-slate-600">Kilométrage: <p
                                        className="font-normal">{car["kilometer"]}</p></li>
                                    <li className="font-Barlow font-semibold text-base text-slate-600">Année: <p
                                        className="font-normal">{car.year}</p></li>
                                    <li className="font-Barlow font-semibold text-base text-slate-600 overflow-auto whitespace-pre-line">Description: <p
                                        className="font-normal">{car.content}</p></li>
                                </ul>
                                <div className="mt-6">
                                    {car.images && car.images.length > 0 && (
                                        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                            {car.images.map((slide, index) => {
                                                const imageId = slide.match(/\/(\d+)$/)[1];
                                                const imagePath = useImagePath(imageId);
                                                return (
                                                    <div
                                                        key={`car_${car.id}_image_${index}`}
                                                        className="relative rounded-lg overflow-hidden group"
                                                    >
                                                        <img
                                                            key={`car_${car.id}_image_${index}`}
                                                            src={`/api/images/${imagePath}`}
                                                            alt={`image de la voiture ${index}`}
                                                            className="w-full h-auto transition-transform duration-300 transform scale-100 group-hover:scale-150"
                                                            style={{maxWidth: '100%', height: 'auto'}}
                                                        />
                                                    </div>
                                                );
                                            })}
                                        </div>
                                    )}
                                </div>

                            </div>

                        </Modal>

                        <div className="flex justify-between mx-2 gap-1">
                            <button
                                className="my-4 font-Barlow font-bold lg:text-xs md:text-sm text-red-600 px-6 inline-block py-2 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white"
                                type="button"
                                onClick={handleClick}
                            >
                                Voir plus
                            </button>
                            <div className="lg:space-y-1 md:space-y-2 text-center my-auto">
                                <button
                                    className="font-Barlow font-bold lg:text-xs md:text-sm text-red-600 px-6 inline-block py-2 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white"
                                    onClick={handleOpenContactModal}
                                >
                                    Demander un renseignement
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <ContactModal isOpen={isContactModalOpen} handleClose={handleCloseContactModal} car={car}/>
        </li>

    </ul>)
}
export default Sale;
