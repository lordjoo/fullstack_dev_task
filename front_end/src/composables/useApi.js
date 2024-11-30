import {apiURL} from "@/config.js";

export const useApi = (path, opts = {}) => {
    opts.mode = 'no-cors';
    return fetch(apiURL + path, opts);
}
