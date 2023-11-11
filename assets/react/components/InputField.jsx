import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faTriangleExclamation} from "@fortawesome/free-solid-svg-icons";

const InputField = ({ label, name, type, register, errors, placeholder }) => (
    <div className="sm:col-span-2">
        <label htmlFor={name} className="block text-sm font-medium font-Barlow text-slate-600">
            {label}
        </label>
        <input
            type={type}
            name={name}
            {...register(name)}
            aria-invalid={errors[name] ? "true" : "false"}
            className="bg-gray-50 border border-slate-600 text-slate-600 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-auto p-2.5 mb-2"
            placeholder={placeholder}
        />
        {errors[name] && (
            <p className="font-medium font-Barlow text-red-600" role="alert">
                <FontAwesomeIcon icon={faTriangleExclamation}/> {errors[name].message}
            </p>
        )}
    </div>
);

export default InputField;