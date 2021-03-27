<template>
    <div>
        <FormBox
            type="användare"
            :timestamps="user ? user.formatted_timestamps : null"
            :submit-label="user ? 'Uppdatera' : 'Lägg till'"
            :loading="form.processing"
            :deleteable="!!user"
            @delete="$emit('delete', form)"
            @submit="$emit('submit', form)"
        >
            <FormGroup
                label="Namn"
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
                label="E-post"
                name="email"
                :error="form.errors.email"
            >
                <InputField
                    v-model="form.email"
                    name="email"
                    type="email"
                    autocomplete="email"
                />
            </FormGroup>

            <FormGroup
                label="Lösenord"
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
        </FormBox>
    </div>
</template>

<script>
import FormBox from '@/Components/Form/FormBox';
import FormGroup from '@/Components/Form/FormGroup';
import InputField from '@/Components/Form/InputField';

export default {
    components: {
        FormBox,
        FormGroup,
        InputField
    },

    props: {
        user: {
            type: Object,
            default: null
        }
    },

    data () {
        return {
            form: this.$inertia.form({
                name: this.user?.name,
                email: this.user?.email,
                password: '',
                password_confirmation: ''
            })
        };
    }
};
</script>
