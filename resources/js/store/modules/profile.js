const profile = {
    namespaced: true,
    state: {
        profile_info: []
    },
    getters: {
        fetchProfileInfo: state => state.profile_info
    },
    actions: {
        //Get Announcements
        getProfileInfo({commit}, username){
            return new Promise((resolve, reject) => {
                axios.get(`http://192.168.1.114:8000/profile/info/${username}`)
                .then(res => {
                    console.log(res.data);
                    commit('STORE_PROFILE_INFO', res.data);
                    resolve(res);
                })
                .catch(error => {
                    console.log(error.response);
                })
            });
        },
        support(NULL, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/profile/support', data , {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res);
                    resolve(res.data);
                })
                .catch(error => {
                    reject(error);
                    console.log(error);
                })
            });
        },
        unsupport(NULL, id){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/profile/unsupport/${id}`)
                .then(res => {
                    console.log(res);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error);
                    reject();
                })
            });
        },
        changeUsername(NULL, data){
            return new Promise((resolve, reject) => {
                axios.put('http://192.168.1.114:8000/profile/change/username', data, {
                    headers:{
                        'Content-Type': 'application/json',
                    }
                })
                .then(res => {
                    console.log(res.data);
                    resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    reject();
                })
            });
        },
        changePassword(NULL, data){
            return new Promise((resolve, reject) => {
                axios.put('http://192.168.1.114:8000/profile/change/password', data, {
                    headers:{
                        'Content-Type': 'application/json',
                    }
                })
                .then(res => {
                    console.log(res);
                    resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    reject();
                })
            });
        },
        unfavouriteQuiz(NULL, id){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/quiz/unfavourite/${id}`)
                .then(res => {
                    console.log(res.data);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                })
            });
        }
    },
    mutations: {
        STORE_PROFILE_INFO(state, data){
            state.profile_info = data;
        }
    }
};

export default profile;