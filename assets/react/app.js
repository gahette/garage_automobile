import React from 'react';
import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import Opinions from "./pages/Opinions";
import Sales from "./pages/Sales";


const App = () => {

    return (
        <>
            <div>
                <BrowserRouter>
                    <Routes>
                        <Route path="/accueil" element={<Home/>}/>
                        <Route path="/sales" element={<Sales/>}/>
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


