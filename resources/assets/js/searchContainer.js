Vue.component('championship-list', require('./components/ChampionshipList'));

let searchContainer = new Vue({
    el: "#searchContainer",
    data: {
        sportSelected: '',
        championships: ''
    },
    methods: {
        getChampionships() {
            axios.get('/api/championships/' + this.sportSelected)
                .then(response => {
                    this.championships = response.data;
                })
                .catch(e => console.log(e) );
        }
    }
});