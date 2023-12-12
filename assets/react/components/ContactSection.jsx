import React, {useRef} from "react";
import emailjs from "@emailjs/browser";
import * as yup from "yup";
import {yupResolver} from '@hookform/resolvers/yup';
import InputField from "./InputField";
import TextareaField from "./TextareaField";
import {useForm} from "react-hook-form";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faPaperPlane} from "@fortawesome/free-regular-svg-icons";

const schema = yup
    .object({
        lastname: yup.string().required('Ce champ est requis'),
        firstname: yup.string().required('Ce champ est requis'),
        email: yup.string().email('Adresse e-mail invalide').required('Ce champ est requis'),
        phone: yup.string().required('Ce champ est requis'),
        content: yup.string().required('Ce champ est requis'),
    })
    .required();


function ContactSection() {
    const form = useRef();
    const sendEmail = (e) => {
        e.preventDefault();

        emailjs.sendForm("service_fnim20r", "template_22urss8", form.current, "xjBWa_8aNxgL3B8mq").then(
            (result) => {
                console.log(result.text);
            },
            (error) => {
                console.log(error.text);
            }
        );
    };


    const {
        register,
        formState: {errors, isSubmitSuccessful},
        handleSubmit,
    } = useForm({
        mode: "onTouched",
        resolver: yupResolver(schema),
    });

    return (
        <section id={"services"} className="bg-slate-200 ">
            <div className="my-32 md:pt-32 container mx-auto">
                <form ref={form} onSubmit={sendEmail}>

                    <div className="flex-column sm:gap-6">
                        <div className="sm:col-span-2">
                            <label htmlFor="subject" className="block text-sm font-medium font-Barlow text-slate-600">Objet</label>
                            <select name="objet" id="objet" className="bg-gray-50 border border-slate-600 text-slate-600 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-auto p-2.5 mb-2">
                                <option value="">---- Choisir une option ----</option>
                                <option value="renseignent">Demande de renseignement</option>
                                <option value="conseil">Demande de conseil</option>
                                <option value="devis">Demande de devis</option>
                            </select>
                        </div>

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
                        <button type="submit"
                                className="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-600 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-white hover:text-red-600 hover:border border-red-600">
                            <p><FontAwesomeIcon icon={faPaperPlane}/> Envoyer</p>
                        </button>
                    </div>
                </form>

            </div>
        </section>
    )

}

export default ContactSection;


// todo: faire une redirection vers accueil ?