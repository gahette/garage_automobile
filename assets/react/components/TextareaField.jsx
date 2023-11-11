import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faTriangleExclamation} from "@fortawesome/free-solid-svg-icons";

const TextareaField = ({ label, name, register, errors, placeholder }) => (
    <div className="sm:col-span-2">
        <label htmlFor={name} className="block text-sm font-medium font-Barlow text-slate-600">
            {label}
        </label>
        <textarea
            id={name}
            name={name}
            {...register(name)}
            rows="8"
            className="block p-2.5 w-full text-sm text-slate-600 bg-gray-50 rounded-lg border border-slate-600 focus:ring-primary-600 focus:border-primary-600"
            placeholder={placeholder}
        />
        {errors[name] && (
            <p className="font-medium font-Barlow text-red-600" role="alert">
                <FontAwesomeIcon icon={faTriangleExclamation}/> {errors[name].message}
            </p>
        )}
    </div>
);

export default TextareaField;