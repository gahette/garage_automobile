import React, {useEffect} from 'react';
import {Link} from "react-router-dom";
import logo from "../logo/logo-transparent.png";
import {usePaginatedFetch} from "./hooks";
import OpeningHours from "./OpeningHours";
import Address from "./Address";

// const DayHours = React.memo(({dayHours: {amCloseHours, amOpenHours, day, pmCloseHours, pmOpenHours}}) => {
//         return <div>
//             <ul>
//                 <li>{day} : {amOpenHours} - {amCloseHours} / {pmOpenHours} - {pmCloseHours}</li>
//             </ul>
//         </div>
//     }
// )

function Footer() {
    const {items: opening_hours, load, loading, count, hasMore} = usePaginatedFetch
    ('/api/opening_hours')

    useEffect(() => {
            load()
        },
        [])

    return (
        <footer className="footer border border-t-slate-400 bg-slate-600 ">
            <div className="container mx-auto pb-11 md:flex md:flex-wrap md:text-left justify-between text-center">
                <div
                    className="bg-white w-32 h-11 rounded mt-16 md:block hidden">
                    <Link to={"/"}>
                        <img src={logo} width="120" height="45.76" alt="logo"/>
                    </Link>
                </div>
                <div className="mt-7 ">
                    <div className="font-Barlow font-medium text-slate-200 text-2xl">
                        Horaires d'ouverture
                    </div>
                    <div className="font-Barlow font-medium text-slate-200">
                        {/*{opening_hours.map((o, index) => <DayHours key={index} dayHours={o}/>)}*/}
                        <OpeningHours/>
                    </div>
                </div>

                <div className="mt-7">
                    <div className="font-Barlow font-medium text-slate-200 text-2xl">
                        Contactez-nous
                    </div>
                    <div className="font-Barlow font-medium text-slate-200">
                        {/*<p>Par téléphone : 0900000000</p>*/}
                        {/*<p>Par email : garage.vparrot@gmsail.com</p>*/}
                        {/*<p>Adresse postale : impasse de la presse</p>*/}
                        {/*<p>31000 Toulouse</p>*/}
                        <Address/>
                    </div>
                </div>
            </div>
            <div className="md:flex md:flex-wrap md:text-left text-center items-center justify-between px-20 pb-2">
                <div className="font-Barlow font-medium text-slate-200 pb-8 md:pb-0">
                    Copyright 2023 Garage V. Parrot.
                </div>
                <div className="md:flex md:flex-wrap md:gap-8 font-Barlow font-medium text-slate-400">
                    <p className="md:pb-0 pb-8">Privacy Policy</p>
                    <p className="md:pb-0 pb-8">Term & Conditions</p>
                    <p className="md:pb-0 pb-8">Cookie Policy</p>
                    <p className="md:pb-0 pb-8">Contact</p>
                </div>
            </div>

        </footer>
    )
        ;
}

export default Footer;