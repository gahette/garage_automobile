import {createRoot} from "react-dom/client"
import React, {useEffect} from "react"
import {useServicesFetch} from "./hooks";
import {unmountComponentAtNode} from "react-dom";


function Service() {
    const {items: services, load, loading} = useServicesFetch
    ('/api/services')

    useEffect(() => {
            load()
        },
        [])


    return <div>
        {loading && 'Chargement...'}
        {JSON.stringify(services)}
        {/*<button onClick={load}>Charger les services</button>*/}

    </div>
}

class ServicesElement extends HTMLElement {

    connectedCallback() {
        const root = createRoot(this);
        root.render(<Service/>)
    }

    disconnectedCallback(root){
        unmountComponentAtNode(this)
        root.unmount()
    }
}

customElements.define('post-service', ServicesElement)