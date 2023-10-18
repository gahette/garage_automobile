// import React from "react";
// import * as ReactDom from "react-dom";
//
// ReactDom.render(
//     <h1>Hello World !</h1>,
//
// document.getElementById("root")
// )

import React from 'react';
import ReactDOM from 'react-dom/client';
import '../styles/app.css';
import App from './app';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
