<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Laravel Vue Datatables Component Example - Tutsmake.com</div>
   
                    <div class="card-body">
                        <datatable :columns="columns" :data="rows"></datatable>
                        <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
   
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
   
<script>
   
    import DatatableFactory from 'vuejs-datatable';
   
    export default {
        components: { DatatableFactory },
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                columns: [
                        {label: 'Despatched', field: 'despatched'}, 
                        {label: 'Delivered', field: 'delivered'},
                        {label: 'From', field: 'from_zone'},
                        {label: 'To', field: 'to_zone'},
                        {label: 'Actual Days', field: 'actualdays'},
                        {label: 'Average Days', field: 'avgdays'},
                        {label: 'Estimated Days', field: 'estimatedays'}
                    ],
                rows: [],
                page: 1,
                per_page: 100,
            }
        },
        methods:{
            getData: function() {
                axios.get('/getvue').then(function(response){
                    this.rows = response.data;
                }.bind(this));
            }
        },
        created: function(){
            this.getData()
        }
    }
</script>