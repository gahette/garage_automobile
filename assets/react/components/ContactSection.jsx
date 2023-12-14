import React from "react";
import Contact from "./Contact";
import Address from "./Address";

function ContactSection() {
    return (
        <section className="bg-slate-200">
            <div className="my-32 md:pt-32 container mx-auto">
                <div
                    className="flex flex-col justify-between font-Rajdhani border-b-2 border- border-slate-400 text-center text-slate-600 my-auto gap-16">
                    <h2 className="font-bold xl:text-5xl lg:text-4xl md:text-2xl">Contactez-nous !</h2>
                    <p className=" mb-24  font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 hidden sm:block">
                        <Address/>
                    </p>
                </div>
                <div className="mt-24">
                    <div
                        className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 my-auto gap-16">
                        <h2 className="font-bold xl:text-5xl lg:text-4xl md:text-2xl">Ou bien remplissez le
                            formulaire</h2>
                        <p className="font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 hidden sm:block">
                            Vos demandes seront traitées dans les plus bref délai</p>
                    </div>
                    <Contact/>
                </div>
            </div>
        </section>
    )

}

export default ContactSection;