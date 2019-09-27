<template>
    <div class="row my-3 table-layout">
        <table id="properties-table" class="display table-bordered nowrap" cellspacing="0" style="width:100% !important;">
            <thead>
                <tr>
                    <th v-for="(header, index) in table_headers" :key="index">{{ header }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</template>

<style scoped>
    .table-layout {
        overflow: hidden;
        overflow-x: scroll;
    }
</style>

<script>
export default {
    name: "TableComponent",
    data() {
        return {
            table_headers: [
                'Title',
                'Description',
                'Bedroom',
                'Bathroom',
                'Property type',
                'Status',
                'For sale',
                'For rent',
                'Project name',
                'Country'
            ],

        }
    },

    mounted(){
        let users = [];

        this.dataTable = $('#properties-table').DataTable({
            pageLength: 20,
            orderCellsTop: true,
            fixedHeader: true,
            processing: true,
            serverSide: true,
            ajax: "/properties/list",
            columns: [
                { "data": "title" },
                { "data": "description" },
                { "data": "bedroom" },
                { "data": "bathroom" },
                { "data": "property_type" },
                { "data": "status" },
                { "data": "for_sale" },
                { "data": "for_rent" },
                { "data": "project_name" },
                { "data": "country" },
            ]
        });
    }
}
</script>

