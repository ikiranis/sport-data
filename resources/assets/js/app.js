
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        matches: matches.data
    },
    methods: {
        postData(key) {

            myData = {
                first_team_score: this.$data.matches[key].first_team_score,
                second_team_score: this.$data.matches[key].second_team_score
            };

            axios.put('/admin/matches/' + this.$data.matches[key].id, myData)
                .then(res => {
                    console.log(res);
                })
                .catch(e => console.log(e));
        }
    }
});
