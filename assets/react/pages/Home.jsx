import React from 'react';
import Header from "../components/Header";
import Footer from "../components/Footer";
import Service from "../components/Service";
import HeroSection from "../components/HeroSection";
import ServiceSection from "../components/ServiceSection";

const Home = () => {
    return (
        <main className="flex min-h-screen flex-col">
            <Header/>
            <HeroSection/>
            <ServiceSection/>
            {/*<div id='services'>*/}
            {/*    <Service/>*/}
            {/*</div>*/}
            <Footer/>
        </main>
    )
        ;
}

export default Home;