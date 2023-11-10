import React from 'react';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faPaperPlane} from "@fortawesome/free-regular-svg-icons";
import {useForm} from "react-hook-form";
import {yupResolver} from "@hookform/resolvers/yup"
import * as yup from "yup"
import {useFetch} from "./hooks";
import {Navigate} from "react-router-dom";
import {faTriangleExclamation} from "@fortawesome/free-solid-svg-icons";

const wait = function (duration = 1000) {
    return new Promise((resolve) => {
        window.setTimeout(resolve, duration)
    })
}

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

    const {
        register,
        formState: {errors, isSubmitSuccessful},
        handleSubmit,
    } = useForm({
        mode: "onTouched",
        resolver: yupResolver(schema),
    });
    const {loading, errors: fetchErrors, load} = useFetch('/api/opinions', 'POST', (response) => {
        if (response) {
            console.log('Réponse de l\'API :', response);
            // Effectuer des actions après la soumission réussie du formulaire
        }
    });

    const onSubmit = async (data) => {
        const formData = {
            ...data,
            isApproved: data.isApproved === undefined || data.isApproved === null ? 0 : data.isApproved,

        };
        try {
            await wait(2000);
            await load(formData); // Envoi des données du formulaire à l'API via useFetch hook
        } catch (error) {
            console.error('Erreur lors de l\'envoi du formulaire :', error);
        }
    };

    if (isSubmitSuccessful) {
        console.log("Redirection ok !")
        return <Navigate to="/"/>;
    }

// console.log(schema)
    console.log(errors)

    return (
        <section className="bg-slate-200">
            <div className="my-32 md:pt-32 container mx-auto">

                <div
                    className="flex flex-col justify-between font-Rajdhani text-center text-slate-600 my-auto mt-32 gap-16">
                    <p className="font-semibold xl:text-5xl lg:text-4xl md:text-2xl mx-30 sm:block">Votre avis
                        nous intéresse !</p>
                </div>

                <div className="flex flex-col items-center justify-center mt-24">
                    {isSubmitSuccessful && <div
                        className="mb-4 font-medium font-Barlow text-slate-400 text-center border rounded-lg bg-green-200 p-2.5">Merci
                        pour votre témoignage !</div>}
                    <form onSubmit={handleSubmit(onSubmit)}>

                        <div className="flex-column sm:gap-6">

                            <div className="sm:col-span-2">
                                <label
                                    htmlFor="name"
                                    className="block text-sm font-medium font-Barlow text-slate-600">
                                    Nom ou pseudo
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    {...register("name")}
                                    aria-invalid={errors.name ? "true" : "false"}
                                    className="bg-gray-50 border border-slate-600 text-slate-600 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-auto p-2.5 mb-2"
                                    placeholder="John Doe"
                                />
                                {errors.name &&
                                    <p className="font-medium font-Barlow text-red-600" role="alert"><FontAwesomeIcon
                                        icon={faTriangleExclamation}/> {errors.name.message}</p>}
                            </div>
                            <div className="sm:col-span-2">
                                <label
                                    htmlFor="mark"
                                    className="block text-sm font-medium font-Barlow text-slate-600">
                                    Note de 0 à 5
                                </label>
                                <input
                                    type="number"
                                    name="mark"
                                    {...register("mark")}
                                    id="mark"
                                    min="0"
                                    max="5"
                                    className="bg-gray-50 border border-slate-600 text-slate-600 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-auto p-2.5 mb-2"
                                    placeholder="5"
                                />
                                {errors.mark &&
                                    <p className="font-medium font-Barlow text-red-600" role="alert"><FontAwesomeIcon
                                        icon={faTriangleExclamation}/> {errors.mark.message}</p>}
                            </div>

                            <div className="sm:col-span-2">
                                <label
                                    htmlFor={name}
                                    className="block text-sm font-medium font-Barlow text-slate-600">
                                    Votre témoignage
                                </label>
                                <textarea
                                    id="content"
                                    name="content"
                                    {...register("content")}
                                    rows="8"
                                    className="block p-2.5 w-full text-sm text-slate-600 bg-gray-50 rounded-lg border border-slate-600 focus:ring-primary-600 focus:border-primary-600"
                                    placeholder="Laisser votre commentaire ici ..."
                                />
                                {errors.content &&
                                    <p className="font-medium font-Barlow text-red-600" role="alert"><FontAwesomeIcon
                                        icon={faTriangleExclamation}/> {errors.content.message}</p>}
                                <div>Les commentaires non conformes à notre code de conduite seront modérés.</div>
                            </div>

                            <input
                                type="hidden"
                                id="is_approved"
                                name="is_approved"
                                {...register("isApproved")}
                                defaultValue={0}


                            />
                        </div>
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
    );
}

export default OpinionForm;
