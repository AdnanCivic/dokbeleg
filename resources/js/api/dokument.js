import axios from "axios";

export default {

    all(params) {
        return axios.get('/api/v1/dokument', {params});
    },

    create(data) {
        return axios.post('/api/v1/dokument', data);
    },

    find(id) {
        return axios.get(`/api/v1/dokument/${id}`);
    },

    update(id, data) {
        return axios.put(`/api/v1/dokument/${id}`, data);
    },

    delete(id) {
        return axios.delete(`/api/v1/dokument/${id}`);
    },

    pdf(id) {
        return axios.get(`/api/v1/dokument/${id}/pdf`);
    }
}