import React from 'react';
import Header from "../components/Header";
import Footer from "../components/Footer";
import SaleSection from "../components/SaleSection";

const Sales = () => {
    return (
        <main className="flex min-h-screen flex-col">
            <Header/>
            <SaleSection/>
            <Footer/>
        </main>
    );
}

export default Sales;