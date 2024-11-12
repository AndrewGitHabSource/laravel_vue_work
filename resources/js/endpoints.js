import { $http } from "./api";

export const getPositions = async () => {
    return await $http.get(route('get.positions'));
}

export const findResume = async (id) => {
    return await $http.get(route('admin.get.resume'), {
        'params': {id},
    });
}

export const searchSkills = async (searchedSkill) => {
    return await $http.get(route('search.skills'), {
        'params': searchedSkill,
    });
}

export const getLanguages = async () => {
    return await $http.get(route('get.languages'));
}

export const searchPortfolios = async (searchedSkill) => {
    return await $http.get(route('search.portfolios'), {
        'params': searchedSkill,
    });
}

export const saveResume = async (resume) => {
    return await $http.post(route('save.resume'), resume, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    });
}

export const updateResume = async (resume) => {
    return await $http.post(route('update.resume'), resume, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    });
}

export const getResumes = async (page = 1) => {
    return await $http.get(route('admin.resumes'), {
        'params': {page},
    });
}

export const searchResumes = async (search) => {
    return await $http.get(route('admin.search.resumes'), {
        'params': search,
    });
}

export const getPositionsAdmin = async (page = 1) => {
    return await $http.get(route('admin.positions'), {
        'params': {page},
    });
}

export const searchPositions = async (search, page) => {
    return await $http.get(route('admin.search.positions'), {
        'params': {search, page},
    });
}

export const savePosition = async (position) => {
    return await $http.post(route('admin.positions.save'), position);
}