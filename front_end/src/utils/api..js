import { ofetch } from "ofetch";
import { apiURL } from "@/config";

export const $api = ofetch.create({
    // Request interceptor
    async onRequest({ options }) {
        options.baseURL = apiURL || '/api';
    },
})
