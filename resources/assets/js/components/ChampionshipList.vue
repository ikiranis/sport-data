<template>
    <select class="form-control col-7 px-2" id="championship_id" name="championship_id">
        <option v-for="championship in championships" :value="championship.id">{{championship.name}}</option>
    </select>
</template>

<script>
    export default {
        props: ['championships']
    }
</script>