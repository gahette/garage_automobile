import React from 'react';
import Service from "../components/Service";
import Header from "../components/Header";
import Footer from "../components/Footer";

const Services = () => {
    return (
        <main className="flex min-h-screen flex-col">

            <Header/>
            <div className=" mt-32">
                <Service/>
            </div>
            <Footer/>
        </main>
    )
};

export default Services;
