import React, {useEffect} from 'react'
import {useImagePath, usePaginatedFetch} from "./hooks";
import {Carousel} from "react-responsive-carousel";


function Team() {
    const {items: users, load, hasMore, hasLess, loading} = usePaginatedFetch('/api/users');

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
                {users.map((user) => (
                    <UserItem key={user.id} user={user}/>
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

const UserItem = ({user}) => {
    if (!user) {
        return null
    }
    return (
        <ul key={`user_${user.id}`} className="bg-white rounded-lg">
            <li>
                <div>
                    {user.images && user.images.length > 0 && (
                        <div>
                            {user.images.length > 1 ? (
                                <Carousel
                                    interval={3000}
                                    autoPlay={true}
                                    infiniteLoop
                                    showIndicators={false}
                                    showStatus={false}
                                    showArrows={false}
                                    showThumbs={true}
                                >
                                    {user.images.map((slide, index) => {
                                        const imageId = slide.match(/\/(\d+)$/)[1];
                                        const imagePath = useImagePath(imageId);
                                        return (
                                            <img
                                                key={`user_${user.id}_image_${index}`}
                                                src={`/api/images/${imagePath}`}
                                                alt={"image de l'équipier"}
                                                className="rounded-t-lg"
                                            />
                                        );
                                    })}
                                </Carousel>
                            ) : (
                                <div>
                                    {user.images.map((slide, index) => {
                                        const imageId = slide.match(/\/(\d+)$/)[1];
                                        const imagePath = useImagePath(imageId);
                                        return (
                                            <img
                                                key={`user_${user.id}_image_${index}`}
                                                src={`/api/images/${imagePath}`}
                                                alt={"image de l'équipier"}
                                                className="rounded-t-lg"
                                            />
                                        );
                                    })}
                                </div>
                            )}
                        </div>
                    )}
                </div>
            </li>
            <h2 className="font-Barlow font-medium text-lg text-slate-400 text-center rounded-b-lg">{user.firstname} {user.lastname}</h2>
            <ul className="mt-6">
                <li className="font-Barlow font-medium text-base text-slate-600 text-center">{user.content}</li>
            </ul>
        </ul>
    );
};

export default Team;


