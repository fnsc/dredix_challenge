<template>
    <li
        class="list-group-item text-center"
        v-html="
            `${startDate} - ${endDate} = <span class='badge badge-success badge-pill'>${
                item.result
            }</span> ${item.result == 1 ? 'day' : 'days'}`
        "
    ></li>
</template>
<script>
export default {
    props: ["item"],
    computed: {
        startDate() {
            return moment(this.item.start_date).format("DD/MM/YYYY");
        },
        endDate() {
            return moment(this.item.end_date).format("DD/MM/YYYY");
        },
    },
};
</script>
