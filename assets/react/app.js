import React from 'react';
import {BrowserRouter, Route, Routes} from "react-router-dom";

function Service() {
    return null;
}

const App = () => {

    return (
        <>
            <div>
                <BrowserRouter>
                    <Routes>
                        <Route path="/accueil" element={<Home/>}/>
                        <Route path="/services" element={<Service/>}/>
                        <Route path="/sell" element={<About/>}/>
                        {/*<Route path="/contact" element={<Contact/>}/>*/}
                        <Route path="*" element={<Home/>}/>
                        <Route path="/connexion" action="/connexion"/>
                        {/*<Route path="/mentionslegales" element={<Legacy/>}/>*/}
                    </Routes>
                </BrowserRouter>
            </div>
        </>

)
}


import Home from "./pages/Home";
import About from "./pages/About";

export default App;

