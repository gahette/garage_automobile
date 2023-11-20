import React from "react";
import Service from "./Service";
import Sale from "./Sale";

function SaleSection() {
    return (
        <section className="bg-slate-200">
            <div className="my-32 md:pt-32 container mx-auto">
                <div className="flex flex-col justify-between font-Rajdhani border-b-2 border- border-slate-400 text-center text-slate-600 my-auto gap-16">
                    <h2 className="font-bold xl:text-5xl lg:text-4xl md:text-2xl">Vente de véhicules d'occasion</h2>
                    <p className=" mb-24  font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 hidden sm:block">
                        Découvrez notre sélection de véhicules d'occasions de qualité à des prix compétitifs. Trouvez le véhicules qui correspond à vos besoins chez nous.
                      </p>
                </div>
                <div className="mt-24">
                   <Sale/>
                </div>
            </div>
        </section>
    )

}

export default SaleSection;