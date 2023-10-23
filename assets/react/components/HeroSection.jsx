import React from "react";
import logo from '../logo/logo-transparent.png';

function HeroSection() {
    return (
        <section className="mt-30 bg-slate-400">
            <div className="my-32 container mx-auto">
                <img src={logo} className="mx-auto h-1/2 w-1/2"  alt="logo"/>
            <div className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 my-auto mt-32 gap-16">
                <h1 className=" font-bold xl:text-5xl lg:text-4xl md:text-2xl">Bienvenue chez nous</h1>
                <p className="font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 hidden sm:block">Votre partenaire de confiance pour l'entretien et la réparation automobile à Toulouse.</p>
                <p className="font-semibold xl:text-2xl lg:text-xl md:text-sm mx-30">Bienvenue chez Garage V.Parrot, votre expert en réparation automobile à Toulouse. Fort de 15 ans d'expérience dans l'industrie, Vincent Parrot et son équipe sont déterminés à offrir des services de qualité et une relation de confiance avec chaque client.</p>
            </div>
            </div>
        </section>
    )
}

export default HeroSection;