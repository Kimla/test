<template>
    <div>
        <FormBox
            type="Message"
            :timestamps="message ? message.formatted_timestamps : null"
            :submit-label="message ? 'Update' : 'Create'"
            :loading="form.processing"
            :deleteable="!!message"
            @delete="$emit('delete', form)"
            @submit="$emit('submit', form)"
        >
            <FormGroup
                label="Title"
                name="title"
                :error="form.errors.title"
            >
                <InputField
                    v-model="form.title"
                    name="title"
                    type="text"
                />
            </FormGroup>

            <FormGroup
                label="Bild"
                name="image"
            >
                <ImageField
                    name="image"
                    :image="form.image"
                    @change="image => (form.image = image)"
                />
            </FormGroup>

            <FormGroup
                label="Content"
                name="content"
                :error="form.errors.content"
            >
                <Editor v-model="form.content" />
            </FormGroup>
        </FormBox>
    </div>
</template>

<script>
import FormBox from '@/Components/Form/FormBox';
import Editor from '@/Components/Form/Editor';
import FormGroup from '@/Components/Form/FormGroup';
import InputField from '@/Components/Form/InputField';
import ImageField from '@/Components/Form/ImageField';

export default {
    components: {
        FormBox,
        Editor,
        FormGroup,
        InputField,
        ImageField
    },

    props: {
        message: {
            type: Object,
            default: null
        }
    },

    data () {
        return {
            form: this.$inertia.form({
                title: this.message?.title || '',
                image: this.message?.image || null,
                content: this.message?.content || ''
            })
        };
    }
};
</script>
