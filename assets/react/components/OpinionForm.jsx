import React, {useState} from 'react';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faPaperPlane} from "@fortawesome/free-regular-svg-icons";
import {useForm} from "react-hook-form";
import {yupResolver} from "@hookform/resolvers/yup"
import * as yup from "yup"
import {useFetch} from "./hooks";
import {Navigate} from "react-router-dom";
import InputField from "./InputField";
import TextareaField from "./TextareaField";


// Schéma de validation Yup pour le formulaire
const schema = yup
    .object({
        content: yup
            .string()
            .required("Vous devez entrer un témoignage"),
        isApproved: yup
            .boolean()
            .default(false),
        mark: yup
            .number()
            .typeError("Vous devez donner une note de 0 à 5")
            .positive("La note doit être un nombre positif")
            .integer("La note doit être un nombre entier")
            .required("Vous devez donner une note de 0 à 5")
            .min(0, "La note doit être au moins 0")
            .max(5, "La note doit être au plus 5"),
        name: yup
            .string()
            .required("Vous devez entrer un nom d'utilisateur")
            .min(3, "Vous devez entrer au moins 3 caractères"),
    })
    .required()

function OpinionForm() {
// Initialisation du hook useForm pour gérer le formulaire
    const {
        register,
        formState: {errors, isSubmitSuccessful},
        handleSubmit,
    } = useForm({
        mode: "onTouched",
        resolver: yupResolver(schema),
    });

    // Utilisation du hook useFetch pour effectuer une requête POST vers /api/opinions
    const {loading, errors: fetchErrors, load} = useFetch('/api/opinions', 'POST', (response) => {
        if (response) {
            console.log('Réponse de l\'API :', response);
        }
    });

    // Hooks d'état pour gérer la redirection et l'affichage du message de succès
    const [redirect, setRedirect] = useState(false);
    const [showSuccessMessage, setShowSuccessMessage] = useState(false)

    // Fonction appelée lors de la soumission du formulaire
    const onSubmit = async (data) => {
        const formData = {
            ...data,
            isApproved: data.isApproved === undefined || data.isApproved === null ? 0 : data.isApproved,

        };
        try {
            // Envoi des données du formulaire à l'API
            await load(formData);
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

// Si la redirection est activée et la soumission est réussie, effectuer la redirection
    if (redirect && isSubmitSuccessful) {
        console.log("Performing redirect...");
        return <Navigate to="/"/>;
    }

    return (
        <section className="bg-slate-200">
            <div className="my-32 md:pt-32 container mx-auto">

                <div
                    className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 my-auto mt-32 gap-16">
                    <p className="font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 sm:block">Votre avis
                        nous intéresse !</p>
                </div>

                <div className="flex flex-col items-center justify-center mt-24">
                    <form onSubmit={handleSubmit(onSubmit)}>

                        <div className="flex-column sm:gap-6">

                            <InputField
                                label="Nom ou pseudo"
                                name="name"
                                type="text"
                                register={register}
                                errors={errors}
                                placeholder="John Doe"
                            />
                            <InputField
                                label="Note de 0 à 5"
                                name="mark"
                                type="number"
                                register={register}
                                errors={errors}
                                placeholder="5"
                            />


                            <TextareaField
                                label="Votre témoignage"
                                name="content"
                                register={register}
                                errors={errors}
                                placeholder="Laisser votre commentaire ici ..."
                            />
                            <div>Les commentaires non conformes à notre code de conduite seront modérés.</div>


                            <input
                                type="hidden"
                                id="isApproved"
                                name="isApproved"
                                {...register("isApproved")}
                                defaultValue={0}
                            />

                        </div>
                        {showSuccessMessage && (
                            <div className="mb-4 font-medium font-Barlow text-slate-400 text-center border rounded-lg bg-green-200 p-2.5">
                                Merci pour votre témoignage !
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
            </div>
        </section>
    )
        ;
}

export default OpinionForm;
