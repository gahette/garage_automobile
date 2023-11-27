import React, {useEffect, useState} from 'react';
import {useForm} from 'react-hook-form';
import {yupResolver} from '@hookform/resolvers/yup';
import * as yup from 'yup';
import {useFetch} from "./hooks";
import InputField from "./InputField";
import TextareaField from "./TextareaField";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faPaperPlane} from "@fortawesome/free-regular-svg-icons";

const schema = yup
    .object({
        users: yup.string(),
        cars: yup.string(),
        lastname: yup.string().required('Ce champ est requis'),
        firstname: yup.string().required('Ce champ est requis'),
        email: yup.string().email('Adresse e-mail invalide').required('Ce champ est requis'),
        phone: yup.string().required('Ce champ est requis'),
        content: yup.string().required('Ce champ est requis'),
    })
    .required();

function ContactForm({carId, car, user, handleClose}) {
    const {
        register,
        formState: {errors, isSubmitSuccessful},
        handleSubmit,
    } = useForm({
        mode: "onTouched",
        resolver: yupResolver(schema),
    });

    // Utilisation du hook useFetch pour effectuer une requête POST vers /api/opinions
    const {loading, errors: fetchErrors, load} = useFetch('/api/messages', 'POST', (response) => {
        if (response) {
            console.log('Réponse de l\'API :', response);
        }
    });


    // Hooks d'état pour gérer la redirection et l'affichage du message de succès
    const [redirect, setRedirect] = useState(false);
    const [showSuccessMessage, setShowSuccessMessage] = useState(false)

    // Si la redirection est activée et la soumission est réussie, effectuer la redirection
    useEffect(() => {
        if (redirect && isSubmitSuccessful) {
            handleClose();
        }
    }, [redirect, isSubmitSuccessful, handleClose]);

    const onSubmit = async (data) => {

        // Vérifiez que carId est défini et est un nombre
        if (carId === undefined || isNaN(Number(carId))) {
            console.error('Erreur : carId n\'est pas un nombre valide.');
            return;
        }
        const formData = {
            ...data,
            carsId: parseInt(carId, 10),
            carsUser: parseInt(user, 10),
        };
        try {
            // Envoi des données du formulaire à l'API
            await load(formData);
            console.log(carId, user);
            // Affichage du message de succès
            setShowSuccessMessage(true);
            // Redirection vers la page d'accueil après un délai de 2 secondes
            setTimeout(() => {
                setRedirect(true);
            }, 2000);
        } catch (error) {
            console.error('Erreur lors de l\'envoi du formulaire :', error);
        }
    };


    return (

        <div>
            <h2>{carId}</h2>
            <h2>{car.name}</h2>
            <form onSubmit={handleSubmit(onSubmit)}>

                <div className="flex-column sm:gap-6">


                    <input
                        name="users"
                        type="hidden"
                        {...register("users")}
                        value={car.user !== undefined ? car.user : 0}
                    />

                    <input
                        name="cars"
                        type="hidden"
                        {...register("cars")}
                        // errors={errors}
                        value={`/api/cars/${car.id}`}
                    />

                    <InputField
                        label="Nom"
                        name="lastname"
                        type="text"
                        register={register}
                        errors={errors}
                        placeholder="Doe"
                    />

                    <InputField
                        label="Prénom"
                        name="firstname"
                        type="text"
                        register={register}
                        errors={errors}
                        placeholder="John"
                    />

                    <InputField
                        label="Email"
                        name="email"
                        type="text"
                        register={register}
                        errors={errors}
                        placeholder="johndoe@example.com"
                    />

                    <InputField
                        label="Téléphone"
                        name="phone"
                        type="text"
                        register={register}
                        errors={errors}
                        placeholder="0000000000"
                    />

                    <TextareaField
                        label="Message"
                        name="content"
                        register={register}
                        errors={errors}
                        placeholder="Laisser votre message ..."
                    />
                    <div>Vos données collectées seront enregistrées pour le seul usage du
                        garage V.Parrot.
                    </div>


                </div>
                {showSuccessMessage && (
                    <div
                        className="mb-4 font-medium font-Barlow text-slate-400 text-center border rounded-lg bg-green-200 p-2.5">
                        Votre demande a bien été envoyé !
                    </div>
                )}

                {fetchErrors && (
                    <div className="mb-4 text-red-600">
                        {fetchErrors.message}
                    </div>
                )}

                <button
                    type="submit"
                    disabled={loading}
                    className="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-600 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-white hover:text-red-600 hover:border border-red-600">
                    <p><FontAwesomeIcon icon={faPaperPlane}/> Envoyer</p>
                </button>

            </form>
        </div>
    )
        ;
}


export default ContactForm;


