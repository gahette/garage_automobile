import React, {useEffect} from 'react';
import {useImagePath, usePaginatedFetch} from './hooks';
import "react-responsive-carousel/lib/styles/carousel.min.css";
import {Carousel} from "react-responsive-carousel";

const Sale = () => {
    const {items: cars, load, hasMore, hasLess, loading} = usePaginatedFetch('/api/cars');

    useEffect(() => {
        load(); // Charger les premières voitures lorsque le composant est monté
    }, []);

    const loadMore = () => {
        if (hasMore) {
            load(); // Charger plus de voitures lorsque le bouton "Load More" est cliqué
        }
    };

    const loadLess = () => {
        if (hasLess) {
            load();
        }

    }

    return (
        <div>
            {loading && 'Chargement...'}
            <div className="my-16">
                <ul className="grid md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-5 grid-cols-1 gap-6">
                    {cars.map((car) => (
                        <CarItem key={car.id} car={car}/>
                    ))}
                </ul>
            </div>
            <div className="lg:space-y-1 md:space-y-2 text-center my-auto">
                {hasMore && (
                    <button
                        className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-auto"
                        onClick={loadMore} disabled={loading}>
                        {loading ? 'Chargement...' : 'Suivant'}
                    </button>
                )}
                {hasLess && (
                    <button
                        className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-auto"
                        onClick={loadLess} disabled={loading}>
                        {loading ? 'Chargement...' : 'Précédent'}
                    </button>
                )}
            </div>
        </div>
    );
};

const CarItem = ({car}) => {
    return (
        <ul>

            <li key={`car_${car.id}`} className="bg-white rounded-lg">

                <div>
                    {car.images && car.images.length > 0 && (

                        <ul>
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
                                            <li key={`car_${car.id}_image_${index}`}>
                                                <img
                                                    src={`/api/images/${imagePath}`}
                                                    // width={240}
                                                    alt={"image de la voiture"}
                                                    className=" rounded-t-lg"
                                                />
                                            </li>
                                        );
                                    })}
                                </Carousel>
                            ) : (
                                <ul>
                                    {car.images.map((slide, index) => {
                                        const imageId = slide.match(/\/(\d+)$/)[1];
                                        const imagePath = useImagePath(imageId);
                                        return (
                                            <li key={`car_${car.id}_image_${index}`}>
                                                <img
                                                    src={`/api/images/${imagePath}`}
                                                    // width={240}
                                                    alt={"image de la voiture"}
                                                    className=" rounded-t-lg"
                                                />
                                            </li>
                                        );
                                    })}
                                </ul>
                            )}
                        </ul>
                    )}
                </div>

                <div className="mb-8">
                    <h2 className="font-Barlow font-medium text-lg text-slate-400 text-center rounded-b-lg">{car.name}</h2>
                    <ul className="mt-6">
                        <li className="font-Barlow font-medium text-base text-slate-600 text-center">Marque: {car.brand}</li>
                        <li className="font-Barlow font-medium text-base text-slate-600 text-center">Modèle: {car.model}</li>
                        <li className="font-Barlow font-medium text-base text-slate-600 text-center">Kilométrage: {car.kilometer}</li>
                        <li className="font-Barlow font-medium text-base text-slate-600 text-center">Année: {car.year}</li>
                    </ul>

                </div>

            </li>

        </ul>
    )
}
export default Sale;
