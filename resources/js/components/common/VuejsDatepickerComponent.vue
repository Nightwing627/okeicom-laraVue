<template>
    <datepicker
        :value="defaultdate"
        :format="this.DatePickerFormat"
        :name="name"
        :language="ja"
        input-class="form-control bg-white"
        :disabled-dates="disabledDates"
        clear-button="true"
        @click="showResetButton"
        ref="datepicker"
    >
    </datepicker>
</template>

<script>
import datepicker from 'vuejs-datepicker/src/components/Datepicker.vue'
import { ja } from "vuejs-datepicker/dist/locale"

export default {
    components: {
        datepicker
    },
    props: {
        name: {
            type: String,
            required: true
        },
        defaultdate: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            DatePickerFormat: "yyyy-MM-dd",
            ja: ja,
            disabledDates: {
                to: new Date(Date.now() - 86400000)
            },
        };
    },
    methods: {
    }
};
</script>
