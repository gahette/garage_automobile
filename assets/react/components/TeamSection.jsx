import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faArrowRight} from "@fortawesome/free-solid-svg-icons";
import Team from "./Team";

function TeamSection() {
    return (
        <section id={"services"} className="bg-slate-200 ">
            <div className="my-32 md:pt-32 container mx-auto">
                <div className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 my-auto gap-16">
                    <h2 className="font-bold xl:text-5xl lg:text-4xl md:text-2xl">Découvrez Notre Équipe</h2>
                    <p className="font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 hidden sm:block">Découvrez
                        notre équipe,
                        qui est prête à vous aider, à vous conseiller
                       N'hésitez pas à les solliciter.
                    Elle sera ravi de répondre à vos questions</p>
                </div>
                <div className="mt-24">
                    <Team/>
                </div>
                <div className="lg:space-y-1 md:space-y-2 text-center my-auto">
                    <a href={"/contact"}
                       className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-6 inline-block py-5 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-auto">
                        Prendre rendez-vous <FontAwesomeIcon icon={faArrowRight}/>
                    </a>
                </div>
            </div>
        </section>
    )

}

export default TeamSection;