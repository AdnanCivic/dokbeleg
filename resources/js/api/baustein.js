export default {

    all(params) {
        return axios.get('/api/v1/baustein', {params});
    },

    create(data) {
        return axios.post('/api/v1/baustein', data);
    },

    find(id) {
        return axios.get(`/api/v1/baustein/${id}`);
    },

    update(id, data) {
        return axios.put(`/api/v1/baustein/${id}`, data);
    },

    delete(id) {
        return axios.delete(`/api/v1/baustein/${id}`);
    }
}
