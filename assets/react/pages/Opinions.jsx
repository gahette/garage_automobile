import React from 'react';
import Header from "../components/Header";
import Footer from "../components/Footer";
import OpinionForm from "../components/OpinionForm";

const Opinions = () => {
    return (
        <main className="flex min-h-screen flex-col">
            <Header/>
            <OpinionForm/>
            <Footer/>
        </main>
    );
}

export default Opinions;
