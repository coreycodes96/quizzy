const quiz_feedback = {
    namespaced: true,
    state: {
        quiz_feedback: []
    },
    getters: {
        fetchQuizFeedback: state => state.quiz_feedback
    },
    actions: {
        //Get Announcements
        getQuizFeedback({commit}, id){
            return new Promise((resolve, reject) => {
                axios.get(`http://192.168.1.114:8000/quiz_feedback/show/${id}`)
                .then(res => {
                    console.log(res.data);
                    commit('STORE_QUIZ_FEEDBACK', res.data);
                    resolve(res);
                })
                .catch(error => {
                    console.log(error.response);
                })
            });
        },
        createQuizFeedback({commit}, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/quiz_feedback/create/', data , {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res);
                    resolve(res.data);
                    commit('ADD_QUIZ_FEEDBACK', res.data);
                })
                .catch(error => {
                    reject(error);
                    console.log(error);
                })
            });
        },
        deleteQuizFeedback({commit}, data){
            console.log(data);
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/quiz_feedback/delete/${data.id}`)
                .then(() => {
                    resolve();
                    commit('REMOVE_QUIZ_FEEDBACK', data.quiz_feedback_index);
                })
                .catch(error => {
                    console.log(error);
                    reject();
                })
            });
        },
        favouriteQuizFeedback({commit}, data){
            console.log(data);
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/quiz_feedback/favourite/', {
                    'user_id': data.user_id,
                    'quiz_feedback_id': data.quiz_feedback_id
                }, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log(res.data);
                    resolve(res.data);

                    const result = {
                        'index': data.quiz_feedback_index,
                        'data': res.data,
                    };

                    commit('ADD_QUIZ_FEEDBACK_FAVOURITE', result);
                })
                .catch(error => {
                    reject(error);
                    console.log(error);
                })
            });
        },
        unfavouriteQuizFeedback(NULL, id){
            console.log(id);
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/quiz_feedback/unfavourite/${id}`)
                .then(res => {
                    console.log(res);
                    resolve(res.data);
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                })
            });
        }
    },
    mutations: {
        STORE_QUIZ_FEEDBACK(state, data){
            state.quiz_feedback = data;
        },
        ADD_QUIZ_FEEDBACK(state, data){
            state.quiz_feedback.unshift(data);
        },
        REMOVE_QUIZ_FEEDBACK(state, index){
            state.quiz_feedback.splice(index, 1);
        },
        ADD_QUIZ_FEEDBACK_FAVOURITE(state, result){
            console.log(state.quiz_feedback[result.index]);
            state.quiz_feedback[result.index].quiz_feedback_favourites.unshift(result.data);
        }
    }
};

export default quiz_feedback;