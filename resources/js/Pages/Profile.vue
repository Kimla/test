<template>
    <div>
        <h1 class="heading">
            {{ __('My account') }}
        </h1>

        <FormBox
            submit-label="Update"
            :loading="form.processing"
            :show-side="false"
            @submit="updateProfile"
        >
            <FormGroup
                label="Name"
                name="name"
                :error="form.errors.name"
            >
                <InputField
                    v-model="form.name"
                    name="name"
                    type="text"
                />
            </FormGroup>

            <FormGroup
                label="Email"
                name="email"
                :error="form.errors.email"
            >
                <InputField
                    v-model="form.email"
                    name="email"
                    type="email"
                />
            </FormGroup>

            <FormGroup
                label="Password"
                name="password"
                :error="form.errors.password"
            >
                <InputField
                    v-model="form.password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                />
            </FormGroup>

            <FormGroup
                :label="__('Password confirm')"
                name="password_confirmation"
            >
                <InputField
                    v-model="form.password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                />
            </FormGroup>
        </FormBox>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import FormBox from '@/Components/Form/FormBox';
import FormGroup from '@/Components/Form/FormGroup';
import InputField from '@/Components/Form/InputField';

export default {
    components: {
        FormBox,
        FormGroup,
        InputField
    },

    layout: AppLayout,

    props: {
        user: {
            type: Object,
            required: true
        }
    },

    data () {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                password: '',
                password_confirmation: ''
            })
        };
    },

    methods: {
        updateProfile () {
            this.form.put(route('profile.update', this.user.id), {
                errorBag: 'updateProfile',
                preserveScroll: true
            });
        }
    }
};
</script>

<style lang="postcss" scoped>
.heading {
    margin-bottom: 25px;

    @media (--mobile) {
        margin-bottom: 20px;
    }
}
</style>
