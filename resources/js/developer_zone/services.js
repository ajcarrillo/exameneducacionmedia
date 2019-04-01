window.axios = require('axios');
window.Vue = require('vue');

let initialState = JSON.parse(window.__INITIAL_STATE__);

let app = new Vue({
    el: '#app',
    data: {
        billyStatus: false,
        initialState: {},
    },
    computed: {
        billyStatusCaption() {
            return this.billyStatus ? 'OnLine' : 'Can\'t connect';
        },
        billyStatusBackCaption(){
            return this.initialState.billyStatus ? 'OnLine' : 'Can\'t connect';
        }
    },
    created() {
        this.initialState = initialState;
    },
    mounted() {
        let billyServiceUrl = `${this.initialState.billyServiceUrl}/check-service-on-line`;

        axios.get(billyServiceUrl)
            .then(res => {
                if (res.status === 200) {
                    this.billyStatus = true;
                }
            })
            .catch(err => {
                console.log(err.response);
            })
    }
});

