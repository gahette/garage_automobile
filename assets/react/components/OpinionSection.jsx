import React from "react";
import Opinion from "./Opinion";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faArrowRight} from "@fortawesome/free-solid-svg-icons";

function OpinionSection() {
    return (<section className="bg-slate-400">
        <div className="my-20 container mx-auto">
            <div className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 my-auto gap-16">
                <h2 className="font-bold xl:text-5xl lg:text-4xl md:text-2xl">Vos Témoignages</h2>
            </div>
            <Opinion/>
            <div className="lg:space-y-1 md:space-y-2 text-center my-auto">
                <a href={"#"}
                   className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 bg-slate-200 hover:bg-slate-600 hover:text-white mx-auto">
                    Écrire un commentaire <FontAwesomeIcon icon={faArrowRight}/>
                </a>
            </div>
        </div>
    </section>)
}

export default OpinionSection;