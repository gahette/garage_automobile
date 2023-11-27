import React from "react";
import {useEffect, useRef} from "react";


function Modal({ children, isOpen, handleClose }) {
    const dialogRef = useRef(null);

    const close = () => {
        dialogRef.current?.close();
    };

    useEffect(() => {
        const dialog = dialogRef.current;
        if (isOpen && !dialogRef.current?.open) {
            dialog?.showModal();
        } else {
            dialog?.close();
        }
    }, [isOpen]);

    return (
        <dialog
            ref={dialogRef}
            className={`fixed inset-0 overflow-y-auto w-2/3 ${isOpen ? 'block' : 'hidden'}`}
            onClose={handleClose}
        >
            <div className="flex items-center justify-center p-4">
                <div className="bg-white w-full p-8 rounded border border-red-600 shadow-md">
                    {children}

                    <button
                        type="button"
                        onClick={close}
                        title="close modal"
                        aria-label="close modal"
                        className="my-5 mr-0 bottom-4 p-2 border rounded hover:bg-slate-200 focus:outline-none focus:ring focus:border-red-600"
                    >
                        Fermer
                    </button>
                </div>
            </div>
        </dialog>
    );
}
export default Modal;