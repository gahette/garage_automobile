import React, {useState} from 'react';
import {Link, NavLink} from "react-router-dom";
import logo from '../logo/logo-transparent.png';
import {Bars3Icon, XMarkIcon} from "@heroicons/react/24/solid";

const navLinks = [
    {
        title: "Accueil",
        id: "/",
    },
    {
        title: 'Services',
        id: '/services',
    },
    {
        title: 'Vente de véhicules d\'occasion',
        id: '/sell',
    },
    {
        title: 'Équipe & expertise',
        id: 'team',
    },
    {
        title: 'Contact',
        id: 'contact',
    },
    {
        title: 'Prendre rendez-vous',
        id: 'rdv',
    },
]


function Header() {
    const [toggle, setToggle] = useState(false);

    return (


        <nav className="fixed top-0 left-0 right-0 bg-white z-10 opacity-90">
            <div
                className="flex flex-wrap items-center justify-between mx-auto p-6 cursor-pointer border border-b-red-600">
                <Link to={"/"}>
                    <img src={logo} width="120" height="45.76" alt="logo"/>
                </Link>
                <div className="mobile-menu block md:hidden">
                    {
                        !toggle ? (
                            <button
                                onClick={() => setToggle(true)}
                                className="flex items-center px-3 py-2 border rounded border-red-600 text-red-600 hover:text-slate-400 hover:border-slate-400">
                                <Bars3Icon className="h-5 w-5"/>
                            </button>
                        ) : (
                            <button
                                onClick={() => setToggle(false)}
                                className="flex items-center px-3 py-2 border rounded border-red-600 text-red-600 hover:text-slate-400 hover:border-slate-400">
                                <XMarkIcon className="h-5 w-5"/>
                            </button>
                        )
                    }
                </div>

                {/*sidebar*/}
                <div
                    className={`${
                        !toggle ? "hidden" : "flex"
                    } p-6 bg-black-gradient absolute top-20 right-0 mx-4 my-2 min-w-[140px] rounded-xl sidebar`}
                >
                    <ul className="list-none flex justify-end items-start flex-1 flex-col bg-white p-3">
                        {navLinks.map((nav, index) => (
                            <li
                                key={index}
                                className="block py-3 font-Barlow font-bold text-slate-400 xl:text-base lg:text-sm md:text-xs rounded md:p-0 hover:text-red-600 "
                            >
                                <NavLink to={nav.id}
                                         className={'[&.active]:text-red-600 [&.active]:border-b-2 border-red-600 py-1'}>
                                    {nav.title}
                                </NavLink>
                            </li>
                        ))}
                    </ul>
                </div>

                <div className="menu hidden md:block md:w-auto" id="navbar">
                    <ul className="items-center flex p-8 md:p-0 md:flex-row md:space-x-8">
                        {
                            navLinks.map((nav, index) => (
                                <li key={index}
                                    className="block pl-3 pr-4 font-Barlow font-bold text-slate-400 xl:text-base lg:text-sm md:text-xs rounded md:p-0 hover:text-red-600 "
                                >
                                    <NavLink to={nav.id}
                                             className={'[&.active]:text-red-600 [&.active]:border-b-2 border-red-600 py-3'}>
                                        {nav.title}
                                    </NavLink>
                                </li>
                            ))
                        }


                        <div className="lg:space-y-1 md:space-y-2">
                            <a href={"/connexion"}
                               className="font-Barlow font-bold lg:text-base md:text-sm text-red-600 px-5 inline-block py-3 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-white mx-4">
                                Connexion
                            </a>
                            <a href={""}
                               className="font-Barlow font-bold lg:text-base md:text-sm text-white bg-red-600 px-5 inline-block py-3 w-full sm:w-fit rounded-md border border-red-600 hover:bg-slate-400 hover:text-red-600">
                                Déconnection
                            </a>
                        </div>

                    </ul>
                </div>
            </div>
        </nav>

    )
        ;
}

export default Header;