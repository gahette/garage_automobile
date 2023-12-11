import React from 'react';
import Header from "../components/Header";
import Footer from "../components/Footer";
import TeamSection from "../components/TeamSection";

const Teams = () => {
    return (
        <main className="flex min-h-screen flex-col">
            <Header/>
            <TeamSection/>
            <Footer/>
        </main>
    );
}

export default Teams;