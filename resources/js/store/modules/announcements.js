const announcements = {
    namespaced: true,
    state: {
        announcements: []
    },
    getters: {
        fetchAnnouncements: state => state.announcements
    },
    actions: {
        //Get Announcements
        getAnnouncements({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/announcements/show')
                .then(res => {
                    console.log(res.data);
                    commit('STORE_ANNOUNCEMENTS', res.data);
                    resolve(res);
                })
            });
        }
    },
    mutations: {
        STORE_ANNOUNCEMENTS(state, data){
            state.announcements = data;
        }
    }
};

export default announcements;