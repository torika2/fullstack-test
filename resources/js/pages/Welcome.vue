<template>
    <div class="main-bg">
        <div class="container d-flex flex-column justify-content-center">
            <div class="d-flex justify-content-center py-4">
                <img src="/assets/images/crypto.svg" height="150" alt="">
            </div>
            <h1 class="text-dark text-uppercase text-center">CRYPTO</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col" class="text-end">Last update</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in Object.keys(data)">
                    <th scope="row">
                        <h3 class="m-0 pt-2 text-secondary"><b>{{item}}/EUR</b></h3>
                    </th>
                    <td></td>
                    <td></td>
                    <td>
                        <h4 class="m-0 pt-2">{{getDataByKey(item, 'rate')}}<b>EUR</b></h4>
                    </td>
                    <td>
                        <div class="d-flex flex-column justify-content-end text-end text-secondary font-weight-bold">
                            <div>HIGH</div>
                            <h5 v-text="getDataByKey(item, 'high')"></h5>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column justify-content-end text-end text-secondary font-weight-bold">
                            <div>LOW</div>
                            <h5 v-text="getDataByKey(item, 'low')"></h5>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default{
    name : 'Welcome',
    data(){
        return {
            data : [],
        }
    },
    created(){
        this.getLastData()
        this.listenDataRateEvent()
    },
    methods : {
        getLastData(){
            axios.get('/api/last')
                .then((response)=>{
                    this.data = response.data
                })
        },
        listenDataRateEvent(){
            Echo.channel('get-last-data')
                .listen('.EventDataRates',(e)=>{
                    this.data = response.data
                })
        },
        getDataByKey(key, variable = null){
            if(!variable){
                return this.data[key]
            }
            return this.data[key][variable]
        }
    }
}
</script>
<style>
.main-bg{
    background:#f4f6f9;
    height:100vh;
}
</style>
