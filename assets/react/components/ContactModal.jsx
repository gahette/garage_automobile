import React from 'react';
import Modal from './Modal';
import ContactForm from './ContactForm';

const ContactModal = ({ isOpen, handleClose, car }) => {
    return (
        <Modal isOpen={isOpen} handleClose={handleClose}>
            <div className="overflow-hidden">
                <h2 className="font-Barlow font-medium text-lg text-slate-400 text-center rounded-b-lg">
                    Formulaire de Contact
                </h2>

                <div className="mt-6">
                    <ContactForm car={car} carId={car.id} user={car.user} handleClose={handleClose}/>
                </div>
            </div>
        </Modal>
    );
};

export default ContactModal;
