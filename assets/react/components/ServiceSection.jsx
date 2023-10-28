import React from "react";
import tyre_change from '../serviceImages/tyre-change.jpg';
import brake from '../serviceImages/brake.jpg';
import Service from "./Service";

function ServiceSection() {
    return (
        <section className="bg-slate-200">
            <div className="my-20 container mx-auto">
                <div className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 gap-16">
                    <h2 className="font-bold xl:text-5xl lg:text-4xl md:text-2xl">Découvrez Nos services</h2>
                    <p className="font-semibold xl:text-2xl lg:text-xl md:text-sm mx-30">Découvrez tout ce que le Garage
                        V.
                        Parrot peut faire pour votre véhicule. Explorez nos services et trouvez la solution adaptée à
                        vos
                        besoins.</p>
                </div>
                <div className="mt-24">
                    <Service/>
                </div>


                {/*<div className="bg-slate-400 rounded">*/}
                {/*    <img src={brake} alt=""/>*/}
                {/*    <div>Pneumatique & tenue de route</div>*/}
                {/*    <p>Pneu</p>*/}
                {/*    <p>Équilibrage</p>*/}
                {/*    <p>Parallélisme</p>*/}
                {/*    <p>Géométrie</p>*/}
                {/*    <p>Trains Roulants</p>*/}
                {/*    <p>Amortisseurs</p>*/}
                {/*    <p>Triangle de suspenssion</p>*/}
                {/*    <p>Rotules</p>*/}
                {/*</div>*/}
                {/*<div className="bg-slate-400 rounded">*/}
                {/*    <img src="" alt=""/>*/}
                {/*    <div>Pneumatique & tenue de route</div>*/}
                {/*    <p>Pneu</p>*/}
                {/*    <p>Équilibrage</p>*/}
                {/*    <p>Parallélisme</p>*/}
                {/*    <p>Géométrie</p>*/}
                {/*    <p>Trains Roulants</p>*/}
                {/*    <p>Amortisseurs</p>*/}
                {/*    <p>Triangle de suspenssion</p>*/}
                {/*    <p>Rotules</p>*/}
                {/*</div>*/}
                {/*<div className="bg-slate-400 rounded">*/}
                {/*    <img src="" alt=""/>*/}
                {/*    <div>Pneumatique & tenue de route</div>*/}
                {/*    <p>Pneu</p>*/}
                {/*    <p>Équilibrage</p>*/}
                {/*    <p>Parallélisme</p>*/}
                {/*    <p>Géométrie</p>*/}
                {/*    <p>Trains Roulants</p>*/}
                {/*    <p>Amortisseurs</p>*/}
                {/*    <p>Triangle de suspenssion</p>*/}
                {/*    <p>Rotules</p>*/}
                {/*</div>*/}
                {/*<div className="bg-slate-400 rounded">*/}
                {/*    <img src="" alt=""/>*/}
                {/*    <div>Pneumatique & tenue de route</div>*/}
                {/*    <p>Pneu</p>*/}
                {/*    <p>Équilibrage</p>*/}
                {/*    <p>Parallélisme</p>*/}
                {/*    <p>Géométrie</p>*/}
                {/*    <p>Trains Roulants</p>*/}
                {/*    <p>Amortisseurs</p>*/}
                {/*    <p>Triangle de suspenssion</p>*/}
                {/*    <p>Rotules</p>*/}
                {/*</div>*/}


            </div>


</section>
)

}

export default ServiceSection;