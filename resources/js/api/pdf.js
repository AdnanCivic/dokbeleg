export default {

    all(params, id) {
        return axios.get(`/api/v1/dokument/${id}/pdfs`, {params});
    },

    create(id) {
        return axios.get(`/api/v1/dokument/${id}/pdfs/download`, {responseType: 'blob'});
    },

    // find(id) {
    //     return axios.get(`/api/v1/dokument/pdf/${id}`);
    // },

    // delete(id) {
    //     return axios.delete(`/api/v1/dokument/pdf/${id}`);
    // }
}