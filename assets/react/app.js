import React from 'react';
import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import About from "./pages/About";
import Opinions from "./pages/Opinions";


const App = () => {

    return (
        <>
            <div>
                <BrowserRouter>
                    <Routes>
                        <Route path="/accueil" element={<Home/>}/>
                        <Route path="/sell" element={<About/>}/>
                        <Route path="/opinions" element={<Opinions/>}/>
                        <Route path="*" element={<Home/>}/>
                        <Route path="/connexion" action="/connexion"/>
                        {/*<Route path="/mentionslegales" element={<Legacy/>}/>*/}
                    </Routes>
                </BrowserRouter>
            </div>
        </>

)
}




export default App;


