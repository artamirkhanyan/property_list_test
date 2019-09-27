<template>
    <div class="container">
        <div class="row">
            <h1 class="my-3"> Properties List (Server Side DataTable)</h1>
        </div>
        <TableComponent />
    </div>
</template>

<script>

import TableComponent from '../Components/TableComponent';

export default {
    name: 'App',
    components: {
        TableComponent,
    },
}
</script>
