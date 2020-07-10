<template>
    <div class="container-fluid">
        <form
            class="row d-flex justify-content-center"
            enctype="multipart/form-data"
            @keydown="form.errors.clear($event.target.name)"
            @submit.prevent="send"
        >
            <div class="col-md-5 form-group">
                <label for="date_1">Start Date</label>
                <date-picker
                    v-model="form.start_date"
                    format="DD/MM/YYYY"
                    lang="en-us"
                    input-class="form-control"
                    width="100%"
                ></date-picker>
                <small
                    class="text-danger"
                    v-text="form.errors.get('start_date')"
                    v-if="form.errors.has('start_date')"
                ></small>
            </div>
            <div
                class="col-md-2 d-flex justify-content-center align-items-center"
            >
                <span class="font-weight-bold">_</span>
            </div>
            <div class="col-md-5 form-group">
                <label for="date_1">End Date</label>
                <date-picker
                    v-model="form.end_date"
                    format="DD/MM/YYYY"
                    lang="en-us"
                    input-class="form-control"
                    :not-after="
                        form.start_date != '' ? form.start_date : new Date()
                    "
                    width="100%"
                ></date-picker>
                <small
                    class="text-danger"
                    v-text="form.errors.get('end_date')"
                    v-if="form.errors.has('end_date')"
                ></small>
            </div>
            <submit-button button-text="Send"></submit-button>
        </form>
    </div>
</template>
<script>
import Form from "../../form-validation/Form";
import DatePicker from "vue2-datepicker";
export default {
    data() {
        return {
            form: new Form({
                start_date: new Date(),
                end_date: "",
            }),
        };
    },
    components: {
        DatePicker,
    },
    methods: {
        send: _.throttle(
            function() {
                window.events.$emit("loading", true);
                this.form
                    .post("/")
                    .then((result) => {
                        window.events.$emit("loading", false);
                        window.flash("We did it!");
                    })
                    .catch((errors) => {
                        window.events.$emit("loading", false);
                        console.error(errors);
                        window.flash("Something went wrong.", "danger");
                    });
            },
            500,
            { trailing: false }
        ),
    },
};
</script>
