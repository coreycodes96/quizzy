const account = {
    namespaced: true,
    state: {
        faqs: []
    },
    getters: {
        fetchFAQs: state => state.faqs
    },
    actions: {
        //Create an account
        createAccount(NULL, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/register', data, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                })
                .catch(error => {
                    reject(error);
                })
            })
        },
        //Log the user in
        logTheUserIn(NULL, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/login', data, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                })
                .catch(error => {
                    reject(error);
                })
            })
        },
        //FAQ
        getFAQs({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/faq/show')
                .then(res => {
                    console.log(res);
                    commit('STORE_FAQS', res.data)
                    resolve(res);
                })
                .catch(error => {
                    reject(error);
                    console.log(error);
                })
            })
        },
        //Log the user out
        logTheUserOut(){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/logout')
                .then(res => {
                    resolve(res);
                })
                .catch(error => {
                    reject(error);
                })
            });
        }
    },
    mutations: {
        STORE_FAQS(state, data){
            state.faqs = data;
        }
    }
};

export default account;