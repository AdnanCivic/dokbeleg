export default {

    all(params) {
        return axios.get('/api/v1/gruppe', {params});
    },

    create(data) {
        return axios.post('/api/v1/gruppe', data);
    },

    find(id) {
        return axios.get(`/api/v1/gruppe/${id}`);
    },

    update(id, data) {
        return axios.put(`/api/v1/gruppe/${id}`, data);
    },

    delete(id) {
        return axios.delete(`/api/v1/gruppe/${id}`);
    }
}