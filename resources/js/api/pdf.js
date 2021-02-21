export default {

    all(params, id) {
        return axios.get(`/api/v1/dokument/${id}/pdfs`, {params});
    },

    // create(data) {
    //     return axios.post('/api/v1/dokument/pdf', data);
    // },

    // find(id) {
    //     return axios.get(`/api/v1/dokument/pdf/${id}`);
    // },

    // update(id, data) {
    //     return axios.put(`/api/v1/dokument/pdf/${id}`, data);
    // },

    // delete(id) {
    //     return axios.delete(`/api/v1/dokument/pdf/${id}`);
    // }
}