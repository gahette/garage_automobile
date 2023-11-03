import {usePaginatedFetch} from "./hooks";
import React, {useEffect} from "react";
import StarRating from "reactjs-star-rating";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import {Carousel} from "react-responsive-carousel";

function Opinion() {
    const {items: opinions, load, loading} = usePaginatedFetch
    ('/api/opinions')

    useEffect(() => {
            load()
        },
        [])
    return (
        <>
            {loading && 'Chargement...'}

            <div className="my-20 mx-auto w-10/12 bg-white rounded-lg border-2 border-red-600">
                <div>
                    <Carousel
                        interval={3000}
                        autoPlay={true}
                        infiniteLoop
                        showIndicators={false}
                        showStatus={false}
                        showArrows={true}
                        showThumbs={false}
                    >
                        {opinions.map((slide, index) => (
                            <div key={index}>
                                <div className="flex flex-row gap-5">
                                    <div className="flex-column">
                                        <StarRating
                                            maxRating={"5"} // Maximum rating value
                                            color="#F1C644" // Color of stars
                                            size={16} // Size of stars in pixels
                                            className="ml-6 mt-3.5" // For custom styling
                                            defaultRating={slide.mark} // Default rating value
                                            readOnly={true} // Make rating read only
                                            showLabel={false} // Show label
                                        />
                                        <div
                                            className="ml-6 text-base text-slate-600 font-medium font-Barlow">{slide.createdAt}
                                        </div>
                                    </div>
                                    <div
                                        className="font-bold font-Barlow text-slate-600 text-base mt-4  mb-12 ml-6">{slide.name}
                                    </div>
                                </div>

                                <div className="mb-20">{slide.content}</div>
                            </div>
                        ))}
                    </Carousel>
                </div>
            </div>


        </>
    )
}

export default Opinion;

// TODO : autoplay au chargement de la page ??