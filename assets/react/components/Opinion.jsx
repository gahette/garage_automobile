import {usePaginatedFetch} from "./hooks";
import React, {useEffect, useState} from "react";
import StarRating from "reactjs-star-rating";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import {Carousel} from "react-responsive-carousel";


const dateFormat = {
    dateStyle: 'medium',
    timeStyle: 'short',
}

function Opinion() {
    const {items: opinions, load, loading} = usePaginatedFetch
    ('/api/opinions');
    const [approvedOpinions, setApprovedOpinions] = useState([]);

    useEffect(() => {
            const fetchData = async () => {
                await load();
            };
            fetchData().then(() => {

            });
        },
        []);

    useEffect(() => {
        const filteredOpinions = opinions.filter(opinion => opinion.isApproved);
        setApprovedOpinions(filteredOpinions);
    }, [opinions]);

    return (
        <>
            {loading && 'Chargement...'}

            <div className="my-20 mx-auto w-10/12 bg-white rounded-lg border-2 border-red-600">
                <div>
                    {approvedOpinions.length > 0 && (
                        <Carousel
                            interval={2000}
                            autoPlay={true}
                            infiniteLoop
                            showIndicators={false}
                            showStatus={false}
                            showArrows={true}
                            showThumbs={false}
                        >
                            {approvedOpinions.map((slide, index) => (
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
                                                className="ml-6 text-base text-slate-600 font-medium font-Barlow">{(new Date(slide["createdAt"])).toLocaleString(undefined, dateFormat)}
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
                    )}
                </div>
            </div>


        </>
    )
}

export default Opinion;
