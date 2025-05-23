import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import { Tooltip } from 'flowbite';
const flowbitePlugin = require('flowbite/plugin');

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms, flowbitePlugin,
        require('flowbite/plugin')({
            charts: true,
            datatables: true,
            toolbar: true,
            modals: true,
            dropdowns: true,
            popovers: true,
            tooltips: true,
            datepicker: true,
        }),
       
    ], 
};
