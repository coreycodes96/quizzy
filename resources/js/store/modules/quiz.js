const quiz = {
    namespaced: true,
    state: {
        quizzes: []
    },
    getters: {
        fetchQuizzes: state => state.quizzes
    },
    actions: {
        //Get Announcements
        getQuizzes({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/quiz/show')
                .then(res => {
                    console.log(res.data);
                    commit('STORE_QUIZZES', res.data);
                    resolve(res);
                })
                .catch(error => {
                    console.log(error.response);
                })
            });
        },
        createQuiz({commit}, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/quiz/create', data , {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res);
                    resolve(res.data);
                    commit('ADD_QUIZ', res.data);
                })
                .catch(error => {
                    reject(error);
                    console.log(error);
                })
            });
        },
        deleteQuiz({commit}, data){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/quiz/delete/${data.id}`)
                .then(() => {
                    resolve();
                    commit('REMOVE_QUIZ', data.quiz_index);
                })
                .catch(error => {
                    console.log(error);
                    reject();
                })
            });
        },
        favouriteQuiz({commit}, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/quiz/favourite/', {
                    'user_id': data.user_id,
                    'quiz_id': data.quiz_id
                }, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res.data);
                    resolve(res.data);

                    const result = {
                        'index': data.quiz_index,
                        'data': res.data,
                    };

                    commit('ADD_QUIZ_FAVOURITE', result);
                })
                .catch(error => {
                    reject(error);
                    console.log(error);
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
        STORE_QUIZZES(state, data){
            state.quizzes = data;
        },
        ADD_QUIZ(state, data){
            state.quizzes.unshift(data);
        },
        REMOVE_QUIZ(state, index){
            state.quizzes.splice(index, 1);
        },
        ADD_QUIZ_FAVOURITE(state, result){
            state.quizzes[result.index].quiz_favourites.unshift(result.data);
        }
    }
};

export default quiz;