<template>
    <quill-editor
        ref="myQuillEditor"
        :options="editorOption"
        :value="value"
        @change="$emit('input', $event.html)"
    />
</template>

<script>
import '../../../../node_modules/quill/dist/quill.core.css';
import '../../../../node_modules/quill/dist/quill.snow.css';

import { quillEditor } from 'vue-quill-editor';

export default {
    components: {
        quillEditor
    },

    props: {
        value: {
            type: String,
            default: null
        }
    },

    data () {
        return {
            editorOption: {
                placeholder: null,

                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, 4, false] }],

                        ['bold', 'italic', 'link', 'video'],

                        [{ list: 'ordered' }, { list: 'bullet' }]
                    ],
                    clipboard: {
                        matchVisual: false
                    }
                }
            }
        };
    }
};
</script>

<style>
.ql-editor {
    min-height: 14rem;
}

.ql-toolbar.ql-snow {
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}

.ql-container.ql-snow {
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
}
</style>
