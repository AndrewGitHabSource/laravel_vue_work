export const nameRules = [
    v => !!v || 'Name is required',
    v => (v && v.length <= 100) || 'Name must be less than 10 characters',
];
export const lastNameRules = [
    v => !!v || 'Last Name is required',
];
export const emailRules = [
    v => !!v || 'Email is required',
    v => v.match(/^([\w.%+-]+)@([\w-]+\.)+([\w]{2,})$/i),
];
export const phoneRules = [
    v => !!v || 'Phone is required',
];
export const aboutRules = [
    v => !!v || 'About is required',
];
