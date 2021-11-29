const admin = {
    namespaced: true,
    state: {
        user_warnings: [],
        users: [],
        faqs: [],
        announcements: [],
    },
    getters: {
        fetchUserWarnings: state => state.user_warnings,
        fetchUsers: state => state.users,
        fetchFAQs: state => state.faqs,
        fetchAnnouncements: state => state.announcements,
    },
    actions: {
        getUserWarnings({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/admin/get_user_warning')
                .then(res => {
                    console.log(res.data);
                    commit('STORE_USER_WARNINGS', res.data);
                    resolve(res);
                })
                .catch(error => {
                    reject(error);
                    console.log(error.response);
                })
            });
        },
        updateUserWarning({commit}, data){
            return new Promise((resolve, reject) => {
                axios.put('http://192.168.1.114:8000/admin/update_user_warning', data, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res.data);
                    resolve(res);
                    commit('UPDATE_USER_WARNING', res.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        getUsers({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/admin/get_user')
                .then(res => {
                    console.log(res.data);
                    commit('STORE_USERS', res.data);
                    resolve(res);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        deleteUser({commit}, data){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/admin/delete_user/${data.id}`)
                .then(res => {
                    console.log(res.data);
                    commit('REMOVE_USER', data.user_index);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        getFAQs({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/admin/faq/show')
                .then(res => {
                    console.log(res.data);
                    commit('STORE_FAQS', res.data);
                    resolve(res);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        createFAQ({commit}, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/admin/faq/create/', data, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res.data);
                    commit('ADD_FAQ', res.data);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        deleteFAQ({commit}, data){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/admin/faq/delete/${data.id}`)
                .then(res => {
                    console.log(res.data);
                    commit('REMOVE_FAQ', data.faq_index);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        getAnnouncements({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/admin/announcement/show')
                .then(res => {
                    console.log(res.data);
                    commit('STORE_ANNOUNCEMENTS', res.data);
                    resolve(res);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        createAnnouncement({commit}, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/admin/announcement/create/', data, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res.data);
                    commit('ADD_ANNOUNCEMENT', res.data);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
        deleteAnnouncement({commit}, data){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/admin/announcement/delete/${data.id}`)
                .then(res => {
                    console.log(res.data);
                    commit('REMOVE_ANNOUNCEMENT', data.announcement_index);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        },
    },
    mutations: {
        STORE_USER_WARNINGS(state, data){
            state.user_warnings = data;
        },
        UPDATE_USER_WARNING(state, data){
            state.user_warnings.map(user => user.id === data.id ? data : user);
        },
        STORE_USERS(state, data){
            state.users = data;
        },
        REMOVE_USER(state, data){
            state.users.splice(data.userIndex, 1);
        },
        STORE_FAQS(state, data){
            state.faqs = data;
        },
        ADD_FAQ(state, data){
            state.faqs.unshift(data);
        },
        REMOVE_FAQ(state, data){
            state.faqs.splice(data.faq_index, 1);
        },
        STORE_ANNOUNCEMENTS(state, data){
            state.announcements = data;
        },
        ADD_ANNOUNCEMENT(state, data){
            state.announcements.unshift(data);
        },
        REMOVE_ANNOUNCEMENT(state, data){
            state.announcements.splice(data.announcement_index, 1);
        }
    }
};

export default admin;