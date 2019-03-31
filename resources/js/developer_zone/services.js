window.axios = require('axios');
window.Vue = require('vue');

let app = new Vue({
    el: '#app',
    data: {
        billyStatus: false
    },
    computed: {
        billyStatusCaption() {
            return this.billyStatus ? 'OnLine' : 'Can\'t connect';
        }
    },
    mounted() {
        let billyServiceUrl = `${window.BILLY_SERVICE_URL}/check-service-on-line`;

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

