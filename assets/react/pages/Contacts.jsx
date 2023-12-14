import React from 'react';
import Header from "../components/Header";
import Footer from "../components/Footer";
import ContactSection from "../components/ContactSection";

const Contacts = () => {
    return (
        <main className="flex min-h-screen flex-col">
            <Header/>
            <ContactSection/>
            <Footer/>
        </main>
    );
}

export default Contacts;