<template>
    <div class="imageField">
        <VueUploadComponent
            ref="imageUpload"
            v-model="files"
            :input-id="name"
            class="imageUpload relative"
            accept="image/*"
            @input-file="inputFile"
        >
            <div class="flex justify-center items-center ab100">
                <div
                    v-if="!loading && imagePreview"
                    class="imagePreview ab100"
                >
                    <img
                        :src="imagePreview.sizes ? imagePreview.sizes.small.url : imagePreview.source"
                        class="ab100 objectFitCover"
                    >

                    <div class="overlay ab100"></div>

                    <button
                        class="deleteButton"
                        type="button"
                        @click="clear()"
                    >
                        <img
                            src="../../../images/close-circle.svg"
                            alt=""
                            class="w-full h-full"
                            svg-inline
                        >
                    </button>
                </div>

                <div
                    v-if="!loading && !imagePreview"
                    class="uploadIcon"
                >
                    <img
                        svg-inline
                        class="w-full h-full"
                        src="../../../images/image.svg"
                        alt=""
                    >
                </div>

                <div
                    v-if="loading"
                    class="loading flex items-center justify-center ab100"
                >
                    <img
                        svg-inline
                        class="loadingIcon"
                        src="../../../images/spinner.svg"
                        alt=""
                    >
                </div>
            </div>
        </VueUploadComponent>
    </div>
</template>

<script>
import VueUploadComponent from 'vue-upload-component';

export default {
    components: {
        VueUploadComponent
    },

    props: {
        image: {
            type: Object,
            default: null
        },

        name: {
            type: String,
            required: true
        }
    },

    data: () => ({
        loading: false,
        files: [],
        imagePreview: null
    }),

    mounted () {
        this.imagePreview = this.image;
    },

    methods: {
        clear () {
            this.$refs.imageUpload.clear();
            this.imagePreview = null;
            this.$emit('change', null);
        },

        async inputFile (newFile) {
            if (!newFile) {
                this.clear();
                return;
            }

            this.loading = true;

            const fileUrl = await this.uploadFile(newFile);

            this.loading = false;

            if (!fileUrl) {
                this.clear();
                return;
            }

            this.setPreview(fileUrl);
            this.$emit('change', fileUrl);
        },

        setPreview (fileUrl) {
            this.imagePreview = fileUrl;
        },

        async uploadFile ({ file }) {
            const formData = new FormData();
            formData.append('file', file);

            try {
                const res = await axios.post(
                    route('admin.media.store'),
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                );

                return res.data;
            } catch (error) {
                const message =
                    error?.response?.data?.message ||
                    'Something went wrong, please try again later';

                this.$page.props.banner = {
                    message,
                    id: Date.now(),
                    style: 'danger'
                };
            }
        }
    }
};
</script>

<style lang="postcss" scoped>
.imageField {
    line-height: 0;
}

.imageUpload {
    border: 1px solid var(--borderColor);
    border-radius: 4px;
    overflow: hidden;
    width: 14rem;
    height: 14rem;
    max-width: 100%;

    @media (--mobile) {
        width: 10rem;
        height: 10rem;
    }
}

.uploadIcon {
    width: 48px;
    height: 48px;
    color: var(--grey600);
}

.imagePreview {
    z-index: 10;
}

.imagePreview:hover {
    & .overlay {
        opacity: 0.5;

        @media (--largeTablet) {
            opacity: 0.25;
        }
    }

    & .deleteButton {
        opacity: 1;
    }
}

.overlay {
    background-color: #000;
    opacity: 0;
    transition: var(--normalTrans);

    @media (--largeTablet) {
        opacity: 0.25;
    }
}

.deleteButton {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    height: 24px;
    width: 24px;
    opacity: 0;
    z-index: 100;
    color: #fff;

    @media (--largeTablet) {
        opacity: 1;
    }
}

.loading {
    z-index: 1;
}

.loadingIcon {
    width: 36px;
    height: 36px;
    animation-name: rotate;
    animation-duration: 0.8s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    color: var(--primaryColor);
}
</style>
