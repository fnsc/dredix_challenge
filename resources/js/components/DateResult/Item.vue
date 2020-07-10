<template>
    <li
        class="list-group-item text-center"
        v-html="
            `${item.start_date} - ${item.end_date} = <span class='badge badge-success badge-pill'>${item.result}</span>`
        "
    ></li>
</template>
<script>
export default {
    props: ["item"],
};
</script>
