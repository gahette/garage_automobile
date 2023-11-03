import React from "react";
import Service from "./Service";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faArrowRight} from "@fortawesome/free-solid-svg-icons";

function ServiceSection() {
    return (
        <section className="bg-slate-200">
            <div className="my-20 container mx-auto">
                <div className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 my-auto gap-16">
                    <h2 className="font-bold xl:text-5xl lg:text-4xl md:text-2xl">Découvrez Nos services</h2>
                    <p className="font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 hidden sm:block">Découvrez
                        tout ce que le Garage
                        V.
                        Parrot peut faire pour votre véhicule. Explorez nos services et trouvez la solution adaptée à
                        vos
                        besoins.</p>
                </div>
                <div className="mt-24">
                    <Service/>
                </div>
                <div className="mx-36 my-16">
                    <h2 className="font-Barlow text-slate-600 font-bold xl:text-2xl lg:text-xl md:text-sm">Mécanique et
                        Carrosserie</h2>
                    <p className="font-Barlow text-slate-600 font-medium xl:text-2xl lg:text-xl md:text-sm">Nous mettons
                        en oeuvre notre expertise pour réparer la mécanique et la carrosserie de votre véhicule avec
                        soin et précision. Votre satisfaction sont notre priorité.</p>
                    <h2 className="font-Barlow text-slate-600 font-bold xl:text-2xl lg:text-xl md:text-sm">Entretien
                        Régulier</h2>
                    <p className="font-Barlow text-slate-600 font-medium xl:text-2xl lg:text-xl md:text-sm">Assurez la
                        performance de votre voiture en optant pour nos services d'entretien régulier. Votre voiture
                        mérite le meilleur, et nous sommes là pour la maintenir en parfait état.</p>
                </div>
                    <div className="lg:space-y-1 md:space-y-2 text-center my-auto">
                        <a href={"/rdv"}
                           className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-auto">
                            Prendre rendez-vous <FontAwesomeIcon icon={faArrowRight}/>
                        </a>
                    </div>
            </div>
        </section>
    )

}

export default ServiceSection;