import Vue from 'vue';
import Vuex from 'vuex';

import account from './modules/account.js';
import announcements from './modules/announcements.js';
import quiz from './modules/quiz.js';
import quiz_feedback from './modules/quiz_feedback.js';
import profile from './modules/profile.js';
import admin from './modules/admin.js';

Vue.use(Vuex);

export default new Vuex.Store({
	modules:{
		account,
		announcements,
		quiz,
		quiz_feedback,
		profile,
		admin,
	}
});